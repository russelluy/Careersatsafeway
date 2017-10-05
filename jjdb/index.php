<?php

    /*
    * MySQL quickConnect
    * The MySQL quickConnect PHP script is a simple script designed to be a stand alone query browser
    * for developers who have no more access than FTP/SCP and a username/password for a database
    * that requires access only through localhost. Simply add your information to the access
    * list and drop this script into the web root of your hosting. When you access
    * the script you can enter the username and password to connect and browse and run queries against
    * the local database. This is not an end all solution, only a utility in a pinch.

    * WARNING: For security purposes you should NEVER leave this file floating around if you
    * do not need it. Always delete it and keep a local copy with your access_list pre-defined
    * and ready to drop onto a host for quick and dirty access.
    *
    * File written and provided free of charge and liability
    * by Luther Monson (luther.monson@mindsetinternational.com)
    *
    * Free to distribute but please keep credit and warning at the top of the file.
    *
    * Keyboard shortcut Javascript provided by http://www.openjs.com/scripts/events/keyboard_shortcuts/
    */


    /***************************************************************************
        Mysql quickConnect
        written by Luther Monson (luther.monson@mindsetinternational.com
    ***************************************************************************/

    /* Pre-defined constants, change if required but should work out of box */

    /* Name of script file, i.e. index.php */
    define('SCRIPT_NAME', $_SERVER['SCRIPT_NAME']);
    define('QUERY_HISTORY_LIMIT', 20);

    /*
    * Access list for the script. This script works on an inclusive list only,
    * thus you have to add the ipaddress or host name to the list in order to
    * gain access. You can use the * (star, splat, etc.) as a wild card in an ip
    * or host name in order to create a more generic access list based up domains
    * or certain IP ranges.
    */

    $access_list = array(
        'ip' =>     array(
                        '127.0.0.1',
						'65.44.210.2',
                        '68.109.172.93',
                        '66.235.245.2',
                        '70.176.53.45',
                        '68.231.12.220',
                        '68.230.108.85',
                        '67.152.160.2',
						'65.44.210.2'
                    ),
        'host' =>   array(
                        //'*.cox.net'
                    )
    );

    session_start();
    ob_start();

    /* css_include() and js_include() are just for readability purposes */
    echo '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

        <head>
            <title>MySQL quickConnect</title>';
    css_include();
    js_include();
    echo '
            
            <script type="text/javascript" language="javascript">
            ';

            echo <<< EOT_JS
            
                function checkForm() {
                answer = true;
                if (siw && siw.selectingSomething)
                	answer = false;
                return answer;
                }//
            
                function init(){
                    if(document.set_query){
                        shortcut.add("Shift+Enter",function() {
                            document.set_query.submit.click();
                        });
                        if(document.set_query.query){
                            document.set_query.query.focus();
                        }

                    }
                }

                window.onload=init;
EOT_JS;

       echo '
       
       
            </script>
        </head>
        <body>
            <div class="body_container">
        ';

    if(!empty($_GET['logout']))
    {
        /* Check to see if a logout button was clicked */
        session_destroy();
        header('Location: '.SCRIPT_NAME);
    }
    /* Clear schema */
    if(!empty($_GET['schema']))
    {
        /* Check to see if a logout button was clicked */
        $_SESSION['constants']['DB_SCHEMA'] = 'false';
        unset($_SESSION['cache']['tables']);
        unset($_SESSION['cache']['columns']);
        unset($_SESSION['history']);
        header('Location: '.SCRIPT_NAME);
    }

    /* Access List to deny people based upon IP Address/Host name */
    if(has_access($access_list)){
        /* User has never hit this page before and constants are not set */
        if(!isset($_SESSION['constants']))
        {
            if(!empty($_POST['set_constants']))
            {
                /* User is setting constants, set and redirect back to index */
                $post = $_POST;
                unset($post['set_constants']);
                unset($post['submit']);
                $_SESSION['constants'] = $post;
                header('Location: '.SCRIPT_NAME);
            }
            else
            {
                echo '
                    <h1>Login</h1>
                    <form class="set_constants" method="post">
                        <label for="DB_HOST">Host: </label><input class="text" type="text" name="DB_HOST" value="localhost" /><br />
                        <label for="DB_USERNAME">Username: </label><input class="text" type="text" name="DB_USERNAME" value="" /><br />
                        <label for="DB_PASSWORD">Password: </label><input class="text" type="password" name="DB_PASSWORD" value="" /><br />
                        <input type="submit" name="submit" value="Submit" />
                        <input type="hidden" name="DB_SCHEMA" value="false" />
                        <input type="hidden" name="set_constants" value="1" />
                    </form>
                ';
            }

        }
        else if(true)
        {
            /* Initial database constants are set, extract them and connect and show databases */
            foreach($_SESSION['constants'] as $name => $value)
            {
                define($name, $value);
            }

            if($db = @mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD))
            {
                /* Extra layer of database validation just in case */
                if(get_resource_type($db) == 'mysql link')
                {
                    if(constant('DB_SCHEMA') !== 'false')
                    {
                        if(mysql_select_db(DB_SCHEMA, $db))
                        {
                            /* Successful login to database + schema, start your queries */

                            /* SHOW TABLES */
                            $tables = array();
                            if(!isset($_SESSION['cache']['tables']))
                            {
                                $show_tables = "SHOW TABLES";
                                $show_tables = mysql_query($show_tables, $db);
                                while($row = mysql_fetch_assoc($show_tables))
                                {
                                    $tables[] = $row['Tables_in_'.DB_SCHEMA];
                                }
                                $_SESSION['cache']['tables'] = $tables;
                            }
                            else
                            {
                                $tables = $_SESSION['cache']['tables'];
                            }
                            
                            /* Find and clean the query */
                            $query = '';
                            if(!empty($_GET['query']))
                            {
                                $query = urldecode($_GET['query']);
                            }
                            else if(!empty($_POST['query']))
                            {
                                $query = $_POST['query'];
                            }

                            if($query !== '')
                            {
                                if(get_magic_quotes_gpc())
                                {
                                    $query = stripslashes($query);
                                }
                            }
                            query_history($query);
                                                                                    
                            /* Find the tables currently in use with this query. */
                            $matches = array();
                            preg_match_all("/(".implode('|', $tables).")/", $query, $matches);
                            $tables_in_use = array_unique($matches[0]);                            
                            
                            echo '
                            <div class="left show_tables">
                                
                                <ul class="table_list">';                            
                            foreach($tables as $table)
                            {
                                echo '
                                    <li><a href="'.SCRIPT_NAME.'?query='.urlencode('select * from '.$table).'">'.$table . '</a>';
                                
                                
                                if(in_array($table, $tables_in_use)){
                                    $columns = array();
                                    if(!isset($_SESSION['cache']['columns'][$table]))
                                    {
                                        $columns = find_table_columns($table, $db);
                                        $_SESSION['cache']['columns'][$table] = $columns;
                                    }
                                    else
                                    {
                                        $columns = $_SESSION['cache']['columns'][$table];
                                    }

                                    echo '
                                        <ul class="column_list">';
                                    foreach($columns as $column)
                                    {
                                        /* display the columns for currently 'used' table */
                                        echo "<li><a href=\"javascript:void(0);\" onClick=\"insertAtCursorAdvanceCaret(document.set_query.query,'$column');\">$column</a></li>";
                                    
                                    }
                                    echo '
                                        </ul>';
                                    
                                }
                                echo '
                                    </li>';
                            }
                            echo '
                                </ul>
                                
                                <div class="utilities">
                                    <img src="http://www.mysql.com/common/logos/mysql_100x52-64.gif" alt="MySQL quickConnect" />
                                    <h1 id="title">quickConnect</h1>
                                    <hr />
                                    <ul class="utility_links">
                                        <li><a href="'.SCRIPT_NAME.'?schema=true">Pick Schema</a></li>
                                        <li><a href="'.SCRIPT_NAME.'?logout=true"">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                            ';

                            echo '
                            <div class="right">
                            
                                <div class="left query_input">

                                    <form action="'.SCRIPT_NAME.'" name="set_query" class="query" method="post" onsubmit="return checkForm()">
                                        <textarea class="wickEnabled:MYCUSTOMFLOATER" id="query" name="query" wrap="virtual">'.$query.'</textarea><br />
                                        <input type="submit" name="submit" value="Submit" style="display: none;" />
                                    </form>
                            		<table id="MYCUSTOMFLOATER" class="myCustomFloater">
                            		<tr><td>
                            			<div class="myCustomFloaterContent">
                            			you should never be seeing this
                            			</div>
                            		</td></tr>
                            		</table>

                                </div>
                        		<div class="right query_history">
                        		    <table>';
                                        
                            $history = $_SESSION['history'];
                            for($i = count($history) - 1; 0 <= $i; $i--)
                            {
                                if(strlen($history[$i]) > 64)
                                {
                                    $link = substr($history[$i], 0, 64) . '...';
                                }
                                else
                                {
                                    $link = $history[$i];
                                }
                                echo '
                                        <tr>
                                            <td><strong>'.($i + 1).':</strong></td>
                                            <td><a href="'.SCRIPT_NAME.'?query='.urlencode($history[$i]).'">'.$link.'</a></td>
                                        </tr>
                                ';
                            }
                            
                                        
                            echo '
                        		    </table>
                        		</div>
                                <div style="clear: both;"></div>    
                            
                                <div class="query_table">
                            ';
                                                        
                            /* Setup and run the Queries */
                            
                            
                            if($query !== '')
                            {
                                display_query($query, $db);
                            }

                            echo '
                                </div>
                            ';
                            echo '
                           </div>
                           <div style="clear:both;"></div>
                           <div class="footer">
                                Shift + Enter to execute query.
                           </div>';
                        }
                        else
                        {
                            /* Database selected was not valid, destroy and die */
                            session_destroy();
                            die('Connection problem, refresh to try again: '.mysql_error());
                        }
                    }
                    else
                    {
                        if(!empty($_POST['set_schema']))
                        {
                            if(mysql_select_db($_POST['DB_SCHEMA']))
                            {
                                $_SESSION['cache']['tab_complete_values'] = find_tab_complete_values($db);
                                $_SESSION['constants']['DB_SCHEMA'] = $_POST['DB_SCHEMA'];
                            }
                            header('Location: '.SCRIPT_NAME);
                        }
                        else
                        {
                            echo '
                                <h1>Choose Schema</h1>
                            ';
                            $show_databases = "SHOW DATABASES";
                            $schemas = mysql_query($show_databases, $db);
                            while($row = mysql_fetch_assoc($schemas))
                            {
                                echo '
                                    <form class="set_schema" method="post">
                                        <label for="submit">'.$row['Database'].': </label>
                                        <input type="hidden" name="DB_SCHEMA" value="'.$row['Database'].'" />
                                        <input type="submit" name="submit" value="Use" />
                                        <input type="hidden" name="set_schema" value="1" />
                                        <br />
                                    </form>

                                ';
                            }

                        }
                    }
                }
                else
                {
                    session_destroy();
                    die('Connection problem, refresh to try again: '.mysql_error());
                }
            }
            else
            {
                session_destroy();
                die('Connection problem, refresh to try again: '.mysql_error());

            }
        }

        session_write_close();
    }
    else
    {
        die('You do not have access to this script.');
    }

    echo '
        </div>
    </html>
    ';

    $html = ob_get_clean();
    echo $html;


    /* Utility Functions */

    function display_query($query, $db)
    {
        if($query  == '')
        {
            return false;
        }
        else
        {
            $result = mysql_query($query, $db);
            $i = 0;
            
            $affected = true;
            if(!is_resource($result))
            {
                $affected = mysql_affected_rows($db);
                $found_rows = false;
            }
            else
            {
                $total = mysql_num_rows($result);
                $affected = false;
                if(strpos($query, 'sql_calc_found_rows') || strpos($query, 'SQL_CALC_FOUND_ROWS'))
                {
                    $found_rows = "select found_rows()";
                    $found_rows = mysql_query($found_rows, $db);
                    $found_rows = mysql_fetch_row($found_rows);
                    $found_rows = $found_rows[0];
                }
                else
                {
                    $found_rows = false;
                }
                
            }
            
            echo '
                <div><em>Total Rows: '.$total.' '.( $found_rows ? ' - Found Rows: '.$found_rows : '' ).'</em></div>   
                <table class="results">
            ';

            if(!$affected && mysql_num_rows($result) > 0)
            {
                while($row = mysql_fetch_assoc($result))
                {
                    if($i == 0)
                    {
                        /* First Iteration, display the header */
                        echo '
                            <tr>
                                <th class="row_number">&nbsp;</th>
                        ';
                        foreach($row as $column => $value)
                        {
                            echo '
                                <th>'.$column.'</th>
                            ';

                        }
                        echo '</tr>';
                        $i++;
                    }

                    if($i % 2 == 0){
                        $class = 'even';
                    }
                    else
                    {
                        $class = 'odd';
                    }
                    /* Normal row, display each column */
                    echo '
                        <tr class="'.$class.'">
                            <td class="row_number">'.$i.'</td>
                    ';

                    foreach($row as $column => $value)
                    {
                        echo '
                            <td>'.$value.'</td>
                        ';
                    }
                    echo '</tr>';
                    $i++;
                }
            }
            else
            {
                echo '
                    <tr><td>No results returned '.($affected ? ": $affected rows affected." : '').'</tr></td>
                ';
            }
            echo '
                </table>
                <div class="errors">
                    '.mysql_error().'
                </div>
            ';

            return true;
        }
    }

    function query_history($query)
    {

        if(!is_array($_SESSION['history']))
        {
            $_SESSION['history'] = array();
        }
    
        if($query)
        {
            $history = $_SESSION['history'];
            $serialized_history = strtolower(serialize($history));
            
            if(!strpos($serialized_history, strtolower($query)))
            {
                $history[] = $query;
            }
            if(count($history) > QUERY_HISTORY_LIMIT)
            {
                unset($history[count($history) - 1]);
            }
            $_SESSION['history'] = $history;
        }
    }

    function has_access($access_list)
    {
        if($_SESSION['has_access'] === true){
            return true;
        }
        else
        {
            $has_access = false;
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $host_name = @gethostbyaddr($ip_address);
            if(is_array($access_list['ip']))
            {
                foreach($access_list['ip'] as $valid_ip){
                    $valid_ip = str_replace('*', '(.)*', $valid_ip);
                    if(ereg($valid_ip, $ip_address))
                    {
                        $has_access = true;
                    }
                }

            }
            if(!$has_access && is_array($access_list['host']))
            {
                foreach($access_list['host'] as $valid_host){
                    $valid_host = str_replace('*', '(.)*', $valid_host);
                    if(ereg($valid_host, $host_name))
                    {
                        $has_access = true;
                    }
                }
            }

            if($has_access)
            {
                $_SESSION['has_access'] = true;
            }
			return true;
           //return $has_access;
        }

    }
    
    function find_tab_complete_values($db)
    {
        $show_tables = mysql_query('show tables', $db);
        $tables = array();
        $tab_complete_values = array();
        while($i = mysql_fetch_row($show_tables))
        {
            $describe = mysql_query("describe {$i[0]}", $db);
            while ($j = mysql_fetch_row($describe))
            {
                $tab_complete_values[] = $j[0];    
            }
            $tab_complete_values[] = $i[0];
        }
        $uniques = array_unique($tab_complete_values);
        sort($uniques);
        return $uniques;
    }
    
    function find_table_columns($table, $db)
    {
        $show_columns = "DESCRIBE $table";
        $show_columns = mysql_query($show_columns, $db);
        $columns = array();
        while($row = mysql_fetch_row($show_columns))
        {
            $columns[] = ($row[0]);
        }
        return $columns;
    
    }

    function css_include()
    {
?>

        <style type="text/css">
        .body_container{
        	font-family: verdana;
        	font-size: 1.05em;
        }
        
        .left {
            float: left;
            width: 14%;
        }
        .right { float: right; width: 85%; }
        
        .set_constants, .set_schema, .set_query { width: 400px; }
        .set_constants br, .set_schema br, .query br { clear: both; }
        .set_constants label, .set_schema label {
            font-weight: bold;
            float: left;
        }
        .set_constants input, .set_schema input, .set_query input{
        	float: right;
        	font-family: verdana;
        }
        .set_constants input.text {
        	width: 150px;
        }
        
        .query textarea{
           width: 99%;
           height: 140px;
        }
        .query_input {
            width: 59%;
            padding-bottom: 15px;
        }
        .query_history{
            width: 40%;
            height: 142px;
            overflow: auto;
            white-space: nowrap;
        }
        .query_history table{
            list-style: none;
            padding: 0px;
            margin: 0px;
            font-size: .8em;
        }
        
        ul.table_list{
           color: white;
           font-size: .6em;
           margin: 0px;
           padding: 5px;
           list-style: none;
           background-color: #495884;
           overflow: auto;
        }
        ul.table_list a:visited, ul.table_list a:active, ul.table_list a:link{
           color: white;
           text-decoration: none;
        }
        ul.table_list a:hover{
           color: white;
           text-decoration: underline;
        }
        ul.column_list{
           list-style: none;
           margin: 3px;
           padding: 3px;
           border-top: 1px dashed #eee;
        }
        .logout {
            padding-top: 30px;
            text-align: center;
        }
        .results{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: .7em;
        }
        .results th {
            border: 2px solid #EEE;
            padding: 5px;
        }
        .results th.row_number{
           width: 1%;
           background: none;
           border: none;
        }
        .results td {
            padding: 5px;
            border: 2px solid #EEE;
        }
        .results td.row_number{
           background: #CCC;
           border: none;
           text-align: right;
           font-weight: bold;
        }
        .results tr.odd {
            background-color: #FFF;
        }
        .results tr.even {
            background-color: #FFFFB3;
        }
        
        .myCustomFloater{
            position:relative;
            top:5px;
            left:0;
            background-color:#cecece;
            display:none;visibility:hidden
        
        }
        
        .utilities {
            padding-top: 15px;
            text-align: center;
        }
        #title, .utility_links {
            font-family:Trebuchet, Trebuchet MS, Arial, Verdana, sans-serif;
            font-size:14px;
            font-weight:bold;
            color:#333333;
            margin: 0px;
            padding: 0px;
            letter-spacing:1px;
        }
        
        ul.utility_links{
            list-style: none;
            background-color: white;   
        }
        ul.utility_links a:visited, ul.utility_links a:active, ul.utility_links a:link{
           color: #333333;
           text-decoration: none;
        }
        ul.utility_links a:hover{
           color: #333333;
           text-decoration: underline;
        }
        .footer {
            border-top: 1px dashed #333333;
            padding: 5px;
            margin: 25px;
            font-size: 12px;
            font-style: italic;
            text-align: center;   
        }
        
        /*
        WICK: Web Input Completion Kit
        http://wick.sourceforge.net/
        Copyright (c) 2004, Christopher T. Holland,
        All rights reserved.
        
        Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
        
        Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
        Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
        Neither the name of the Christopher T. Holland, nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
        THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
        
        */
        
        .floater {
        position:absolute;
        z-index:2;
        bottom:0;
        right:0;
        display:none;
        padding:0;
        }
        
        .floater td {
        font-family: Gill, Helvetica, sans-serif;
        background-color:white;
        border:1px inset #979797;
        color:black;
        }
        
        .matchedSmartInputItem {
        font-size:0.8em;
        padding: 5px 10px 1px 5px;
        margin:0;
        cursor:pointer;
        }
        
        .selectedSmartInputItem {
        color:white;
        background-color:#3875D7;
        }
        
        #smartInputResults {
        padding:0;margin:0;
        }
        
        .siwCredit {
        margin:0;padding:0;margin-top:10px;font-size:0.7em;color:black;
        }
        </style>          

<?php

    }

    function js_include()
    {
?>
<script type="text/javascript" language="javascript">
<?php
        /* This cache will only be set once when you pick the schema */
        if($_SESSION['cache']['tab_complete_values'])
        {
            $collections = array('ADD','ALL','ALTER','ANALYZE','AND','AS','ASC','ASENSITIVE','BEFORE','BETWEEN','BIGINT','BINARY','BLOB','BOTH','BY','CALL','CASCADE','CASE','CHANGE','CHAR','CHARACTER','CHECK','COLLATE','COLUMN','CONDITION','CONSTRAINT','CONTINUE','CONVERT','CREATE','CROSS','CURRENT_DATE','CURRENT_TIME','CURRENT_TIMESTAMP','CURRENT_USER','CURSOR','DATABASE','DATABASES','DAY_HOUR','DAY_MICROSECOND','DAY_MINUTE','DAY_SECOND','DEC','DECIMAL','DECLARE','DEFAULT','DELAYED','DELETE','DESC','DESCRIBE','DETERMINISTIC','DISTINCT','DISTINCTROW','DIV','DOUBLE','DROP','DUAL','EACH','ELSE','ELSEIF','ENCLOSED','ESCAPED','EXISTS','EXIT','EXPLAIN','FALSE','FETCH','FLOAT','FLOAT4','FLOAT8','FOR','FORCE','FOREIGN','FROM','FULLTEXT','GRANT','GROUP','HAVING','HIGH_PRIORITY','HOUR_MICROSECOND','HOUR_MINUTE','HOUR_SECOND','IF','IGNORE','IN','INDEX','INFILE','INNER','INOUT','INSENSITIVE','INSERT','INT','INT1','INT2','INT3','INT4','INT8','INTEGER','INTERVAL','INTO','IS','ITERATE','JOIN','KEY','KEYS','KILL','LEADING','LEAVE','LEFT','LIKE','LIMIT','LINES','LOAD','LOCALTIME','LOCALTIMESTAMP','LOCK','LONG','LONGBLOB','LONGTEXT','LOOP','LOW_PRIORITY','MATCH','MEDIUMBLOB','MEDIUMINT','MEDIUMTEXT','MIDDLEINT','MINUTE_MICROSECOND','MINUTE_SECOND','MOD','MODIFIES','NATURAL','NOT','NO_WRITE_TO_BINLOG','NULL','NUMERIC','ON','OPTIMIZE','OPTION','OPTIONALLY','OR','ORDER','OUT','OUTER','OUTFILE','PRECISION','PRIMARY','PROCEDURE','PURGE','READ','READS','REAL','REFERENCES','REGEXP','RELEASE','RENAME','REPEAT','REPLACE','REQUIRE','RESTRICT','RETURN','REVOKE','RIGHT','RLIKE','SCHEMA','SCHEMAS','SECOND_MICROSECOND','SELECT','SENSITIVE','SEPARATOR','SET','SHOW','SMALLINT','SONAME','SPATIAL','SPECIFIC','SQL','SQLEXCEPTION','SQLSTATE','SQLWARNING','SQL_BIG_RESULT','SQL_CALC_FOUND_ROWS','SQL_SMALL_RESULT','SSL','STARTING','STRAIGHT_JOIN','TABLE','TERMINATED','THEN','TINYBLOB','TINYINT','TINYTEXT','TO','TRAILING','TRIGGER','TRUE','UNDO','UNION','UNIQUE','UNLOCK','UNSIGNED','UPDATE','USAGE','USE','USING','UTC_DATE','UTC_TIME','UTC_TIMESTAMP','VALUES','VARBINARY','VARCHAR','VARCHARACTER','VARYING','WHERE','WHILE','WITH','WRITE','XOR','YEAR_MONTH','ZEROFILL');
            // removed 'WHEN' because WHERE is used infinitely more often and it was getting annoying.
            foreach($_SESSION['cache']['tab_complete_values'] as $collection){
                $collections[] = $collection;
            }
            $_SESSION['cache']['collections'] = $collections;
            unset($_SESSION['cache']['tab_complete_values']);
        }
        if($_SESSION['cache']['collections']){
            $collections = $_SESSION['cache']['collections'];
            $js = '
                collection = [ \''.implode('\',\'', $collections).'\' ]
            ';
        }
        echo $js;
?>
/**
 * http://www.openjs.com/scripts/events/keyboard_shortcuts/
 * Version : 2.01.A
 * By Binny V A
 * License : BSD
 */
shortcut = {
	'all_shortcuts':{},//All the shortcuts are stored in this array
	'add': function(shortcut_combination,callback,opt) {
		//Provide a set of default options
		var default_options = {
			'type':'keydown',
			'propagate':false,
			'disable_in_input':false,
			'target':document,
			'keycode':false
		}
		if(!opt) opt = default_options;
		else {
			for(var dfo in default_options) {
				if(typeof opt[dfo] == 'undefined') opt[dfo] = default_options[dfo];
			}
		}

		var ele = opt.target
		if(typeof opt.target == 'string') ele = document.getElementById(opt.target);
		var ths = this;
		shortcut_combination = shortcut_combination.toLowerCase();

		//The function to be called at keypress
		var func = function(e) {
			e = e || window.event;

			if(opt['disable_in_input']) { //Don't enable shortcut keys in Input, Textarea fields
				var element;
				if(e.target) element=e.target;
				else if(e.srcElement) element=e.srcElement;
				if(element.nodeType==3) element=element.parentNode;

				if(element.tagName == 'INPUT' || element.tagName == 'TEXTAREA') return;
			}

			//Find Which key is pressed
			if (e.keyCode) code = e.keyCode;
			else if (e.which) code = e.which;
			var character = String.fromCharCode(code).toLowerCase();

			if(code == 188) character=","; //If the user presses , when the type is onkeydown
			if(code == 190) character="."; //If the user presses , when the type is onkeydown

			var keys = shortcut_combination.split("+");
			//Key Pressed - counts the number of valid keypresses - if it is same as the number of keys, the shortcut function is invoked
			var kp = 0;

			//Work around for stupid Shift key bug created by using lowercase - as a result the shift+num combination was broken
			var shift_nums = {
				"`":"~",
				"1":"!",
				"2":"@",
				"3":"#",
				"4":"$",
				"5":"%",
				"6":"^",
				"7":"&",
				"8":"*",
				"9":"(",
				"0":")",
				"-":"_",
				"=":"+",
				";":":",
				"'":"\"",
				",":"<",
				".":">",
				"/":"?",
				"\\":"|"
			}
			//Special Keys - and their codes
			var special_keys = {
				'esc':27,
				'escape':27,
				'tab':9,
				'space':32,
				'return':13,
				'enter':13,
				'backspace':8,

				'scrolllock':145,
				'scroll_lock':145,
				'scroll':145,
				'capslock':20,
				'caps_lock':20,
				'caps':20,
				'numlock':144,
				'num_lock':144,
				'num':144,

				'pause':19,
				'break':19,

				'insert':45,
				'home':36,
				'delete':46,
				'end':35,

				'pageup':33,
				'page_up':33,
				'pu':33,

				'pagedown':34,
				'page_down':34,
				'pd':34,

				'left':37,
				'up':38,
				'right':39,
				'down':40,

				'f1':112,
				'f2':113,
				'f3':114,
				'f4':115,
				'f5':116,
				'f6':117,
				'f7':118,
				'f8':119,
				'f9':120,
				'f10':121,
				'f11':122,
				'f12':123
			}

			var modifiers = {
				shift: { wanted:false, pressed:false},
				ctrl : { wanted:false, pressed:false},
				alt  : { wanted:false, pressed:false},
				meta : { wanted:false, pressed:false}	//Meta is Mac specific
			};

			if(e.ctrlKey)	modifiers.ctrl.pressed = true;
			if(e.shiftKey)	modifiers.shift.pressed = true;
			if(e.altKey)	modifiers.alt.pressed = true;
			if(e.metaKey)   modifiers.meta.pressed = true;

			for(var i=0; k=keys[i],i<keys.length; i++) {
				//Modifiers
				if(k == 'ctrl' || k == 'control') {
					kp++;
					modifiers.ctrl.wanted = true;

				} else if(k == 'shift') {
					kp++;
					modifiers.shift.wanted = true;

				} else if(k == 'alt') {
					kp++;
					modifiers.alt.wanted = true;
				} else if(k == 'meta') {
					kp++;
					modifiers.meta.wanted = true;
				} else if(k.length > 1) { //If it is a special key
					if(special_keys[k] == code) kp++;

				} else if(opt['keycode']) {
					if(opt['keycode'] == code) kp++;

				} else { //The special keys did not match
					if(character == k) kp++;
					else {
						if(shift_nums[character] && e.shiftKey) { //Stupid Shift key bug created by using lowercase
							character = shift_nums[character];
							if(character == k) kp++;
						}
					}
				}
			}

			if(kp == keys.length &&
						modifiers.ctrl.pressed == modifiers.ctrl.wanted &&
						modifiers.shift.pressed == modifiers.shift.wanted &&
						modifiers.alt.pressed == modifiers.alt.wanted &&
						modifiers.meta.pressed == modifiers.meta.wanted) {
				callback(e);

				if(!opt['propagate']) { //Stop the event
					//e.cancelBubble is supported by IE - this will kill the bubbling process.
					e.cancelBubble = true;
					e.returnValue = false;

					//e.stopPropagation works in Firefox.
					if (e.stopPropagation) {
						e.stopPropagation();
						e.preventDefault();
					}
					return false;
				}
			}
		}
		this.all_shortcuts[shortcut_combination] = {
			'callback':func,
			'target':ele,
			'event': opt['type']
		};
		//Attach the function with the event
		if(ele.addEventListener) ele.addEventListener(opt['type'], func, false);
		else if(ele.attachEvent) ele.attachEvent('on'+opt['type'], func);
		else ele['on'+opt['type']] = func;
	},

	//Remove the shortcut - just specify the shortcut and I will remove the binding
	'remove':function(shortcut_combination) {
		shortcut_combination = shortcut_combination.toLowerCase();
		var binding = this.all_shortcuts[shortcut_combination];
		delete(this.all_shortcuts[shortcut_combination])
		if(!binding) return;
		var type = binding['event'];
		var ele = binding['target'];
		var callback = binding['callback'];

		if(ele.detachEvent) ele.detachEvent('on'+type, callback);
		else if(ele.removeEventListener) ele.removeEventListener(type, callback, false);
		else ele['on'+type] = false;
	}
}


function insertAtCursor(myField, myValue) {
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = myValue;
    }
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value = myField.value.substring(0, startPos)+ myValue+ myField.value.substring(endPos, myField.value.length);
    }
    else{
        myField.value += myValue;
    }
}

function insertAtCursorAdvanceCaret(myField, myValue){
    var pos = getCaret(myField);
    insertAtCursor(myField, myValue);
    setCaret(myField, (pos + myValue.length));
}

/* http://www.csie.ntu.edu.tw/~b88039/html/jslib/caret.html */
function getCaret(node) {
    //node.focus(); 
    /* without node.focus() IE will returns -1 when focus is not on node */
    if(node.selectionStart) return node.selectionStart;
    else if(!document.selection) return 0;
    var c		= "\001";
    var sel	= document.selection.createRange();
    var dul	= sel.duplicate();
    var len	= 0;
    dul.moveToElementText(node);
    sel.text	= c;
    len		= (dul.text.indexOf(c));
    sel.moveStart('character',-1);
    sel.text	= "";
    return len;
}

function setCaret(ctrl, pos)
{

    if(ctrl.setSelectionRange)
    {
        ctrl.focus();
        ctrl.setSelectionRange(pos,pos);
    }
    else if (ctrl.createTextRange) {
        var range = ctrl.createTextRange();
        range.collapse(true);
        range.moveEnd('character', pos);
        range.moveStart('character', pos);
        range.select();
    }
}


/*
WICK: Web Input Completion Kit
http://wick.sourceforge.net/
Copyright (c) 2004, Christopher T. Holland
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of the Christopher T. Holland, nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

*/
/* start dhtml building blocks */
function freezeEvent(e) {
if (e.preventDefault) e.preventDefault();
e.returnValue = false;
e.cancelBubble = true;
if (e.stopPropagation) e.stopPropagation();
return false;
}//freezeEvent

function isWithinNode(e,i,c,t,obj) {
answer = false;
te = e;
while(te && !answer) {
	if	((te.id && (te.id == i)) || (te.className && (te.className == i+"Class"))
			|| (!t && c && te.className && (te.className == c))
			|| (!t && c && te.className && (te.className.indexOf(c) != -1))
			|| (t && te.tagName && (te.tagName.toLowerCase() == t))
			|| (obj && (te == obj))
		) {
		answer = te;
	} else {
		te = te.parentNode;
	}
}
return te;
}//isWithinNode

function getEvent(event) {
return (event ? event : window.event);
}//getEvent()

function getEventElement(e) {
return (e.srcElement ? e.srcElement: (e.target ? e.target : e.currentTarget));
}//getEventElement()

function findElementPosX(obj) {
	curleft = 0;
	if (obj.offsetParent) {
		while (obj.offsetParent) {
			curleft += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	}//if offsetParent exists
	else if (obj.x)
		curleft += obj.x
	return curleft;
}//findElementPosX

function findElementPosY(obj) {
	curtop = 0;
	if (obj.offsetParent) {
		while (obj.offsetParent) {
			curtop += obj.offsetTop;
			obj = obj.offsetParent;
		}
	}//if offsetParent exists
	else if (obj.y)
		curtop += obj.y
	return curtop;
}//findElementPosY

/* end dhtml building blocks */

function handleKeyPress(event) {
e = getEvent(event);
eL = getEventElement(e);

upEl = isWithinNode(eL,null,"wickEnabled",null,null);

kc = e["keyCode"];

if (siw && ((kc == 13) || (kc == 9) || (k == 39))) {
	siw.selectingSomething = true;
	if (siw.isSafari) siw.inputBox.blur();   //hack to "wake up" safari
	siw.inputBox.focus();
	siw.inputBox.value = siw.inputBox.value.replace(/[ \r\n\t\f\s]+$/gi,' ');
	hideSmartInputFloater();
} else if (upEl && (kc != 38) && (kc != 40) && (kc != 37) && (kc != 39) && (kc != 13) && (kc != 27)) {
	if (!siw || (siw && !siw.selectingSomething)) {
		processSmartInput(upEl);
	}
} else if (siw && siw.inputBox) {
	siw.inputBox.focus(); //kinda part of the hack.
}

}//handleKeyPress()


function handleKeyDown(event) {
e = getEvent(event);
eL = getEventElement(e);

if (siw && (kc = e["keyCode"])) {
	if (kc == 40) {
		siw.selectingSomething = true;
		freezeEvent(e);
		if (siw.isGecko) siw.inputBox.blur(); /* Gecko hack */
		selectNextSmartInputMatchItem();
	} else if (kc == 38) {
		siw.selectingSomething = true;
		freezeEvent(e);
		if (siw.isGecko) siw.inputBox.blur();
		selectPreviousSmartInputMatchItem();
	} else if ((kc == 13) || (kc == 9) || (kc == 39)) {
		//key was enter, tab or right arrow.
		siw.selectingSomething = true;
		activateCurrentSmartInputMatch();
		freezeEvent(e);
	} else if (kc == 27)  {
		hideSmartInputFloater();
		freezeEvent(e);
	} else {
		siw.selectingSomething = false;
	}
}

}//handleKeyDown()

function handleFocus(event) {
	e = getEvent(event);
	eL = getEventElement(e);
	if (focEl = isWithinNode(eL,null,"wickEnabled",null,null)) {
	if (!siw || (siw && !siw.selectingSomething)) processSmartInput(focEl);
	}
}//handleFocus()

function handleBlur(event) {
	e = getEvent(event);
	eL = getEventElement(e);
	if (blurEl = isWithinNode(eL,null,"wickEnabled",null,null)) {
		if (siw && !siw.selectingSomething) hideSmartInputFloater();
	}
}//handleBlur()

function handleClick(event) {
	e2 = getEvent(event);
	eL2 = getEventElement(e2);
	if (siw && siw.selectingSomething) {
		selectFromMouseClick();
	}
}//handleClick()

function handleMouseOver(event) {
	e = getEvent(event);
	eL = getEventElement(e);
	if (siw && (mEl = isWithinNode(eL,null,"matchedSmartInputItem",null,null))) {
		siw.selectingSomething = true;
		selectFromMouseOver(mEl);
	} else if (isWithinNode(eL,null,"siwCredit",null,null)) {
		siw.selectingSomething = true;
	}else if (siw) {
		siw.selectingSomething = false;
	}
}//handleMouseOver

function showSmartInputFloater() {
if (!siw.floater.style.display || (siw.floater.style.display=="none")) {
	if (!siw.customFloater) {
		x = findElementPosX(siw.inputBox);
		y = findElementPosY(siw.inputBox) + siw.inputBox.offsetHeight;
		//hack: browser-specific adjustments.
		if (!siw.isGecko && !siw.isWinIE) x += 8;
		if (!siw.isGecko && !siw.isWinIE) y += 10;
		siw.floater.style.left = x;
		siw.floater.style.top = y;
	} else {
	//you may
	//do additional things for your custom floater
	//beyond setting display and visibility
	}
	siw.floater.style.display="block";
	siw.floater.style.visibility="visible";
}
}//showSmartInputFloater()

function hideSmartInputFloater() {
if (siw) {
siw.floater.style.display="none";
siw.floater.style.visibility="hidden";
siw = null;
}//siw exists
}//hideSmartInputFloater

function processSmartInput(inputBox) {
if (!siw) siw = new smartInputWindow();
siw.inputBox = inputBox;

classData = inputBox.className.split(" ");
siwDirectives = null;
for (i=0;(!siwDirectives && classData[i]);i++) {
	if (classData[i].indexOf("wickEnabled") != -1)
		siwDirectives = classData[i];
}

if (siwDirectives && (siwDirectives.indexOf(":") != -1)) {
siw.customFloater = true;
newFloaterId = siwDirectives.split(":")[1];
siw.floater = document.getElementById(newFloaterId);
siw.floaterContent = siw.floater.getElementsByTagName("div")[0];
}


setSmartInputData();
if (siw.matchCollection && (siw.matchCollection.length > 0)) selectSmartInputMatchItem(0);
content = getSmartInputBoxContent();
if (content) {
	modifySmartInputBoxContent(content);
	showSmartInputFloater();
} else hideSmartInputFloater();
}//processSmartInput()

function smartInputMatch(cleanValue, value) {
	this.cleanValue = cleanValue;
	this.value = value;
	this.isSelected = false;
}//smartInputMatch

function simplify(s) {
return s.toLowerCase().replace(/^[ \s\f\t\n\r]+/,'').replace(/[ \s\f\t\n\r]+$/,'');
//.replace(/[?,,,?,\u00E9,\u00E8,\u00EA,\u00EB]/gi,"e").replace(/[?,?,\u00E0,\u00E2]/gi,"a").
}//simplify

function getUserInputToMatch(s) {
    var textValue = s;
    var caretPosition = getCaret(siw.inputBox);
    if(siw.lastUserInput){
        var offset = siw.lastUserInput.length + 1
    }
    else{
        var offset = 1;
    }
    
    userInput = textValue.substring(caretPosition - offset, caretPosition);
    if( //all the cases for when you want to start auto-completing
    	caretPosition == 1 || //if you're still at the beginning (i.e. typing select)
    	textValue.charAt(caretPosition - 2) == ' ' || //if the char before input was a space
    	textValue.charAt(caretPosition - 2) == '`' || //if char before input was a backquote (`)
    	textValue.charAt(caretPosition - 2) == '\'' || //if char before input was a single quote
    	userInput.length >= 2 //the user input has already been started and is >= 2 characters
      )
    {
        return userInput;
    }
    else{
        return '';
    }
}//getUserInputToMatch

function getUserInputBase() {
    s = siw.inputBox.value;
    var position = getCaret(siw.inputBox);

    if(siw.lastUserInput){
        var offset = siw.lastUserInput.length + 1;
    }
    else{
        var offset = 1;
    }
    
    a = s.substring(position - offset, position);
	if (a) {
    	a = a.replace(/^(.*\ [ \r\n\t\f\s]*).*$/i,'$1');
    	return a;
    }
    else{
    	return '';
    }
}//getUserInputBase()

function runMatchingLogic(userInput, standalone) {
	userInput = simplify(userInput);
	uifc = userInput.charAt(0).toLowerCase();
	if (uifc == '"') uifc = (n = userInput.charAt(1)) ? n.toLowerCase() : "z";
	if (standalone) userInput = uifc;
	if (siw) siw.matchCollection = new Array();
	pointerToCollectionToUse = collection;
	if (siw && siw.revisedCollection && (siw.revisedCollection.length > 0) && siw.lastUserInput && (userInput.indexOf(siw.lastUserInput) == 0)) {
		pointerToCollectionToUse = siw.revisedCollection;
	} else if (collectionIndex[userInput] && (collectionIndex[userInput].length > 0)) {
		pointerToCollectionToUse = collectionIndex[userInput];
	} else if (collectionIndex[uifc] && (collectionIndex[uifc].length > 0)) {
		pointerToCollectionToUse = collectionIndex[uifc];
	} else if (siw && (userInput.length == 1) && (!collectionIndex[uifc])) {
		siw.buildIndex = true;
	} else if (siw) {
		siw.buildIndex = false;
	}
	
	tempCollection = new Array();

	re1m = new RegExp("^([ \"\>\<\-]*)("+userInput+")","i");
	re2m = new RegExp("([ \"\>\<\-]+)("+userInput+")","i");
	re1 = new RegExp("^([ \"\}\{\-]*)("+userInput+")","gi");
	re2 = new RegExp("([ \"\}\{\-]+)("+userInput+")","gi");
	
	for (i=0,j=0;(i<pointerToCollectionToUse.length);i++) {
		displayMatches = ((!standalone) && (j < siw.MAX_MATCHES));
		entry = pointerToCollectionToUse[i];
		mEntry = simplify(entry);
		if (!standalone && (mEntry.indexOf(userInput) == 0)) {
			userInput = userInput.replace(/\>/gi,'\\}').replace(/\< ?/gi,'\\{');
			re = new RegExp("(" + userInput + ")","i");
			if (displayMatches) {
				siw.matchCollection[j] = new smartInputMatch(entry, mEntry.replace(/\>/gi,'}').replace(/\< ?/gi,'{').replace(re,"<b>$1</b>"));
			}
			tempCollection[j] = entry;
			j++;		
		} else if (mEntry.match(re1m) || mEntry.match(re2m)) {
			if (!standalone && displayMatches) {
				siw.matchCollection[j] = new smartInputMatch(entry, mEntry.replace(/\>/gi,'}').replace(/\</gi,'{').replace(re1,"$1<b>$2</b>").replace(re2,"$1<b>$2</b>"));
			}
			tempCollection[j] = entry;
			j++;
		}
	}//loop thru collection
	if (siw) {
		siw.lastUserInput = userInput;
		siw.revisedCollection = tempCollection.join(",").split(",");
		collectionIndex[userInput] = tempCollection.join(",").split(",");
	}
	if (standalone || siw.buildIndex) {
		collectionIndex[uifc] = tempCollection.join(",").split(",");
		if (siw) siw.buildIndex = false;
	}
}//runMatchingLogic

function setSmartInputData() {
if (siw) {
orgUserInput = siw.inputBox.value;
orgUserInput = getUserInputToMatch(orgUserInput);
userInput = orgUserInput.toLowerCase().replace(/[\r\n\t\f\s]+/gi,' ').replace(/^ +/gi,'').replace(/ +$/gi,'').replace(/ +/gi,' ').replace(/\\/gi,'').replace(/\[/gi,'').replace(/\(/gi,'').replace(/\./gi,'\.').replace(/\?/gi,'');
if (userInput && (userInput != "") && (userInput != '"')) {
	runMatchingLogic(userInput);
}//if userinput not blank and is meaningful
else {
siw.matchCollection = null;
}
}//siw exists ... uhmkaaayyyyy
}//setSmartInputData

function getSmartInputBoxContent() {
a = null;
if (siw && siw.matchCollection && (siw.matchCollection.length > 0)) {
a = '';
for (i = 0;i < siw.matchCollection.length; i++) {
selectedString = siw.matchCollection[i].isSelected ? ' selectedSmartInputItem' : '';
a += '<p class="matchedSmartInputItem' + selectedString + '">' + siw.matchCollection[i].value.replace(/\{ */gi,"&lt;").replace(/\} */gi,"&gt;") + '</p>';
}//
}//siw exists
return a;
}//getSmartInputBoxContent

function modifySmartInputBoxContent(content) {
//todo: remove credits 'cuz no one gives a shit ;] - done
siw.floaterContent.innerHTML = '<div id="smartInputResults">' + content + (siw.showCredit ? ('<p class="siwCredit">Powered By: <a target="PhrawgBlog" href="http://chrisholland.blogspot.com/?from=smartinput&ref='+escape(location.href)+'">Chris Holland</a></p>') : '') +'</div>';
siw.matchListDisplay = document.getElementById("smartInputResults");
}//modifySmartInputBoxContent()

function selectFromMouseOver(o) {
currentIndex = getCurrentlySelectedSmartInputItem();
if (currentIndex != null) deSelectSmartInputMatchItem(currentIndex);
newIndex = getIndexFromElement(o);
selectSmartInputMatchItem(newIndex);
modifySmartInputBoxContent(getSmartInputBoxContent());
}//selectFromMouseOver

function selectFromMouseClick() {
activateCurrentSmartInputMatch();
siw.inputBox.focus();
hideSmartInputFloater();
}//selectFromMouseClick

function getIndexFromElement(o) {
index = 0;
while(o = o.previousSibling) {
index++;
}//
return index;
}//getIndexFromElement

function getCurrentlySelectedSmartInputItem() {
answer = null;
for (i = 0; ((i < siw.matchCollection.length) && !answer) ; i++) {
	if (siw.matchCollection[i].isSelected)
		answer = i;
}//
return answer;
}//getCurrentlySelectedSmartInputItem

function selectSmartInputMatchItem(index) {
	siw.matchCollection[index].isSelected = true;
}//selectSmartInputMatchItem()

function deSelectSmartInputMatchItem(index) {
	siw.matchCollection[index].isSelected = false;
}//deSelectSmartInputMatchItem()

function selectNextSmartInputMatchItem() {
currentIndex = getCurrentlySelectedSmartInputItem();
if (currentIndex != null) {
	deSelectSmartInputMatchItem(currentIndex);
	if ((currentIndex + 1) < siw.matchCollection.length)
 		selectSmartInputMatchItem(currentIndex + 1);
	else
		selectSmartInputMatchItem(0);
} else {
	selectSmartInputMatchItem(0);
}
modifySmartInputBoxContent(getSmartInputBoxContent());
}//selectNextSmartInputMatchItem

function selectPreviousSmartInputMatchItem() {
currentIndex = getCurrentlySelectedSmartInputItem();
if (currentIndex != null) {
	deSelectSmartInputMatchItem(currentIndex);
	if ((currentIndex - 1) >= 0)
 		selectSmartInputMatchItem(currentIndex - 1);
	else
		selectSmartInputMatchItem(siw.matchCollection.length - 1);
} else {
	selectSmartInputMatchItem(siw.matchCollection.length - 1);
}
modifySmartInputBoxContent(getSmartInputBoxContent());
}//selectPreviousSmartInputMatchItem

function activateCurrentSmartInputMatch() {
	baseValue = getUserInputBase();
	if ((selIndex = getCurrentlySelectedSmartInputItem()) != null) {
		addedValue = siw.matchCollection[selIndex].cleanValue;
		        
        var position = getCaret(siw.inputBox);
        var inputBoxValue = siw.inputBox.value;
        
        siw.inputBox.value = inputBoxValue.substring(0, position - siw.lastUserInput.length) + addedValue + inputBoxValue.substring(position);
        
        setCaret(siw.inputBox, position + (addedValue.length - siw.lastUserInput.length ));
		//insertAtCursor(siw.inputBox, addedValue);
        /*
		theString = (baseValue ? baseValue : "") + addedValue + " ";
		siw.inputBox.value = theString;
		*/
		runMatchingLogic(addedValue, true);
	}
}//activateCurrentSmartInputMatch

function smartInputWindow () {
	this.customFloater = false;
	this.floater = document.getElementById("smartInputFloater");
	this.floaterContent = document.getElementById("smartInputFloaterContent");
	this.selectedSmartInputItem = null;
	this.MAX_MATCHES = 15;
	this.isGecko = (navigator.userAgent.indexOf("Gecko/200") != -1);
	this.isSafari = (navigator.userAgent.indexOf("Safari") != -1);
	this.isWinIE = ((navigator.userAgent.indexOf("Win") != -1 ) && (navigator.userAgent.indexOf("MSIE") != -1 ));
	this.showCredit = false;
}//smartInputWindow Object

function registerSmartInputListeners() {
inputs = document.getElementsByTagName("input");
texts = document.getElementsByTagName("textarea");
allinputs = new Array();
z = 0;
y = 0;
while(inputs[z]) {
allinputs[z] = inputs[z];
z++;
}//
while(texts[y]) {
allinputs[z] = texts[y];
z++;
y++;
}//

for (i=0; i < allinputs.length;i++) {
	if ((c = allinputs[i].className) && (c == "wickEnabled")) {
		allinputs[i].setAttribute("autocomplete","OFF");
		allinputs[i].onfocus = handleFocus;
		allinputs[i].onblur = handleBlur;
		allinputs[i].onkeydown = handleKeyDown;
		allinputs[i].onkeyup = handleKeyPress;
	}
}//loop thru inputs
}//registerSmartInputListeners

siw = null;

if (document.addEventListener) {
	document.addEventListener("keydown", handleKeyDown, false);
	document.addEventListener("keyup", handleKeyPress, false);
	document.addEventListener("mouseup", handleClick, false);
	document.addEventListener("mouseover", handleMouseOver, false);
} else {
	document.onkeydown = handleKeyDown;
	document.onkeyup = handleKeyPress;
	document.onmouseup = handleClick;
	document.onmouseover = handleMouseOver;
}

registerSmartInputListeners();

document.write (
'<table id="smartInputFloater" class="floater" cellpadding="0" cellspacing="0"><tr><td id="smartInputFloaterContent" nowrap="nowrap">'
+'<\/td><\/tr><\/table>'
);

//note: instruct users to the fact that no commas should be present in entries.
//it would make things insanely messy.
//this is why i'm filtering commas here:
for (x=0;x<collection.length;x++) {
collection[x] = collection[x].replace(/\,/gi,'');
}//

collectionIndex = new Array();

ds = "";
function debug(s) {
ds += ( s + "\n");
}
</script>

        <?php
    }
?>