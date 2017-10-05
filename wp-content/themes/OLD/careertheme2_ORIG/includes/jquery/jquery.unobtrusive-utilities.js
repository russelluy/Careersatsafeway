/*-----------------------------------------------
	JavaScript Document
	Jquery Unobtrusive Widgets
------------------------------------------------*/
jQuery.unob = {
	/*General Properties*/
	loadingMsg : '<div class="loadingMsg">Loading...</div>', 
	iComp : 'InitComplete_', 
	lightboxState : false, 
	globalFunctionStorage : [],
	guidStr : 'jqFrmVlPlgn',
	guidCnt : 0, 
	
	/*Page Initialization Setup*/
	pageInitStack : [],
	stackPageInit : function(func){ this.pageInitStack.push(func); return jQuery; },
	initPage : function(){ jQuery.each(this.pageInitStack,function(){if(jQuery.isFunction(this)) this();}); return jQuery;},
	
	/*Internal functions*/
	trimLast : function(str){return str.slice(0,str.length-1);}, 
	getNextClassName : function(obj,query){
		var arr = obj.className.split(' ');
		var pos = jQuery.inArray(query,arr)+1;
		return (arr[pos] || false);
	},
	implode : function(glue,arr){
		var str = '';
		for(var i in arr){str += arr[i]+glue;}
		return jQuery.unob.trimLast(str);
	},
	getHtmlObject : function(descrip){
		var el = document.createElement(descrip.tagName);
		for(var i in descrip) if(i!='tagName') el[i] = descrip[i];
		return el;
	},
	markAjaxUrl : function(str){
		var initChar = (str.indexOf('?')==-1) ? '?' : '&';
		return str+initChar+'_ApplRequest=ajax';
	},
	registerGlobalFunc : function(func){
		jQuery.unob.globalFunctionStorage.push(func);
		return jQuery.unob.globalFunctionStorage.length-1;
	},
	getUniqueId : function(){
		var ret = jQuery.unob.guidStr+jQuery.unob.guidCnt;
		jQuery.unob.guidCnt++;
		return ret;
	},
	
	/*Adding our own Initializations*/
	classToggler : function(){
		jQuery('.toggleclass').each(function(){
			if(!jQuery(this).attr(jQuery.unob.iComp+'classToggle')){
				jQuery(this).click(function(){
					if(jQuery(this).hasClass('toggled')){
						jQuery(this).toggleClass('toggled');
					} else {
						var targ = jQuery.unob.getNextClassName(this,'toggleclass');
						var obj = (targ) ? document.getElementById(targ) : this;
						jQuery(obj).toggleClass('toggled');
					}
				}); jQuery(this).attr(jQuery.unob.iComp+'classToggle',true);
			} 
		});
	},
	displayToggler : function(){
		jQuery('.toggledisplay').each(function(){
			if(!jQuery(this).attr(jQuery.unob.iComp+'dispToggle')){
				jQuery(this).click(function(){
					var targ = jQuery.unob.getNextClassName(this,'toggledisplay');
					var obj = document.getElementById(targ);
					jQuery(obj).slideToggle('medium');
				}); jQuery(this).attr(jQuery.unob.iComp+'dispToggle',true);
			}
		});
	},
	checkAlls : function(){
		jQuery('input.checkall').click(function(){
			var cSearch = jQuery.unob.getNextClassName(this,'checkall');
			var status = this.checked;
			if(cSearch){ jQuery('input.'+cSearch).each(function(){this.checked = status;}); }
		});
	},
	mouseovers : function(){
		jQuery('img.mouseover').each(function(){
			if(!jQuery(this).attr('OrigSrc')){
				jQuery(this).attr('OrigSrc',this.src);
				
				if(!jQuery(this).attr('AltSrc')){
					var sArr = this.src.split('/');
					var nm = sArr.pop();
					for(var j=nm.length-1;j>=0;j--){
						var comp = nm.charAt(j);
						if(comp=='1' || comp=='2'){ 
							newSrc = jQuery.unob.implode('/',sArr)+'/'+nm.substr(0,j)+((comp=='1') ? '2' : '1')+nm.substr(j+1,nm.length-j); 
							break;
						}
					}
					jQuery(this).attr('AltSrc',newSrc);
				}
				
				/*jQuery(this).mouseout(function(){this.src = jQuery(this).attr('OrigSrc');});
				jQuery(this).mouseover(function(){
					this.src = jQuery(this).attr('AltSrc');
				});*/
				this.onmouseover = function(){this.src = this.getAttribute('AltSrc');};
				this.onmouseout = function(){this.src = this.getAttribute('OrigSrc');};
			}
		});
	},
	
	/*Lightbox functions*/
	escapeLightbox : function(e){ 
		if(e.keyCode==27 && jQuery.unob.lightboxState==true){ 
			jQuery.unob.unlightbox(); 
			jQuery.unob.lightboxState = false;
		}
	}, 
	unlightbox : function(){
		jQuery('#lightbox_darkLayer').slideUp(function(){jQuery(this).remove();});
		jQuery('.lightbox_mainContent').each(function(){
			if(jQuery(this).attr('lbDynamic')) jQuery(this).slideUp(function(){jQuery(this).remove();});
			else jQuery(this).slideUp();
		});
	}, 
	lightboxDarkScreen : function(){
		var dark = document.getElementById('lightbox_darkLayer');
		if(!dark){
			var d = jQuery.unob.getHtmlObject({tagName:'div',id:'lightbox_darkLayer'});
			document.body.appendChild(d);
			dark = d;
		} jQuery(dark).slideDown('medium');
	},
	lightbox : function(html){
		jQuery.unob.lightboxDarkScreen();
		jQuery.unob.lightboxState = true;
		var ret = null;
		switch(typeof(html)){
			case 'object':
				jQuery(html).slideUp();
				if(!jQuery(html).hasClass('lightbox_mainContent')) jQuery(html).attr('className','lightbox_mainContent');
				jQuery(html).show('medium');
				ret = html; 
				break;
			case 'string':
			case 'integer':
				var d = jQuery.unob.getHtmlObject({tagName:'div',className:'lightbox_mainContent'});
				var dHelper = jQuery.unob.getHtmlObject({tagName:'div',className:'lbhelper',innerHTML:html});
				var closer = jQuery.unob.getHtmlObject({tagName:'a',className:'lightbox_CloserBtn',innerHTML:'Close'});
				closer.href = 'javascript:void(0)';
				closer.onclick = function(){jQuery.unob.unlightbox();};
				jQuery(d).attr('lbDynamic',true);
				d.appendChild(closer); 
				d.appendChild(dHelper); 
				document.body.appendChild(d);
				jQuery(d).slideDown('medium');
				ret = dHelper;
				break;
			default:
				break;
		}
		return ret;
	},
	
	/*Global Loading Display Message*/
	indicateGlobalLoading : function(){
		var d = jQuery.unob.getHtmlObject({tagName:'div',className:'global_loading_message',innerHTML:this.loadingMsg});
		d.style.display = 'none';
		document.body.appendChild(d);
		jQuery(d).slideDown();
	},
	clearGlobalLoading : function(){
		jQuery('.global_loading_message').slideUp('medium',function(){jQuery('.global_loading_message').remove();});
	},
	
	/*Tooltip Functions*/
	globalTooltipObject : null, 
	initTooltip : function(){
		jQuery('.tooltiptrigger').each(function(){
			if(!jQuery(this).attr(jQuery.unob.iComp+'initTooltip')){
				jQuery('.tooltiptrigger').mouseover(function(){ jQuery.unob.showTooltip(this); }); 
				jQuery('.tooltiptrigger').mouseout(function(){ jQuery.unob.killTooltip(); }); 
				jQuery(this).attr(jQuery.unob.iComp+'initTooltip',true);
			}
		}); 
	}, 
	showTooltip : function(trigger){
		var dest = jQuery(trigger).attr('tooltip_target');
		if(!dest){
			var targ = jQuery.unob.getNextClassName(trigger,'tooltiptrigger')
			jQuery(trigger).attr('tooltip_target',targ);
			var o = document.getElementById(targ);
		} else { 
			var o = document.getElementById(dest); 
		}
		jQuery.unob.globalTooltipObject = o;
		if(!jQuery(o).hasClass('tooltipdisplay')) jQuery(o).addClass('tooltipdisplay');
		jQuery().mousemove(jQuery.unob.positionTip);
		jQuery(o).show();
	},
	positionTip : function(e){
		e = e || event;
		var o = jQuery.unob.globalTooltipObject; 
		var newX = e.pageX+7; var newY = e.pageY+7; 
		var pageBottomCutoff = jQuery(window).scrollTop()+jQuery(window).height();
		var pageLeftCutoff = jQuery(window).scrollLeft()+jQuery(window).width();
		var boxWidth = jQuery(o).outerWidth();
		var extensionHeight = newY+jQuery(o).outerHeight(); var extensionWidth = newX+boxWidth; 
		if(extensionHeight>pageBottomCutoff) newY = newY-(extensionHeight - pageBottomCutoff); 
		if(extensionWidth>pageLeftCutoff) newX = newX-(boxWidth+14);
		o.style.top = newY+'px';
		o.style.left = newX+'px'; 
	},
	killTooltip : function(){
		jQuery(jQuery.unob.globalTooltipObject).hide();
		jQuery().unbind('mousemove',jQuery.unob.positionTip);
	},
	
	/*Form Validation Functions*/
	validationInit : function(jq){
		jq = jq || jQuery('form');
		jq.each(function(){
			if(!jQuery(this).attr(jQuery.unob.iComp+'validateForm')){
				if(typeof(this.onsubmit)=='function'){
					var key = jQuery.unob.registerGlobalFunc(this.onsubmit);
					jQuery(this).attr('gFuncRef',key);
				}
				this.onsubmit = function(){
					if(jQuery(this).attr('gFuncRef')){
						if(jQuery.unob.validateForm(this)){
							return jQuery.unob.globalFunctionStorage[jQuery(this).attr('gFuncRef')]();
						} else {
							return false;
						}
					} else {
						return jQuery.unob.validateForm(this);
					}
				};
				jQuery(this).attr(jQuery.unob.iComp+'validateForm',true);
			}
		});
	},
	formErrors : [],
	formHasErrors : null, 
	validationSectionDelimiter : '__',
	validationPrefix : 'Validate__', /*Use Section Delimiter on the end too*/
	validationRuleDelimiter : '|', 
	validateForm : function(f){
		jQuery.unob.formErrors = {};
		jQuery.unob.formHasErrors = false;
		for(var i=0;i<f.length;i++){
			if(f[i].name){
				var nm = f[i].name;
				if(nm.substr(0,jQuery.unob.validationPrefix.length)==jQuery.unob.validationPrefix){ /*if we have the prefix, validate it*/
					var rules = jQuery.unob.getRules(nm); /*get our rules*/
					var testVal = jQuery.trim(jQuery.unob.getFieldValue(f[i])); /*Strip leading / trailing whitespace*/
					for(var j=0;j<rules.length;j++){ 
						if(rules[j]=='req'){
							if(f[i].getAttribute('clearOnFocus_origValue') && f[i].getAttribute('clearOnFocus_origValue')==testVal){
								testVal='';
							}
						}
						if(jQuery.unob.formRules[rules[j]]){ /*If our rule function exists, run it*/
							if(!jQuery.unob.formRules[rules[j]](testVal)){ /*If validation fails...*/
								if(jQuery.inArray('req',rules)!=-1){ /*check if it's required and stack the error*/
									jQuery.unob.stackFormError(f[i],rules[j]); 
									jQuery.unob.formHasErrors = true;
								} else {
									if(jQuery.unob.formRules.req(testVal)){ /*if it's not required, but we actually have a value that's not empty...*/
										jQuery.unob.stackFormError(f[i],rules[j]);  /* ...Then stack the error. Otherwise if it's empty we let it go becuase it's not required.*/
										jQuery.unob.formHasErrors = true;
									}
								}
							}
						}
					}
				}
			}
		}
		if(jQuery.unob.formHasErrors) jQuery.unob.notifyErrors();
		return !jQuery.unob.formHasErrors;
	}, 
	stackFormError : function(obj,rule){
		var assoc = new Array(2);
		var theName = (obj.title) ? obj.title : this.cleanName(obj.name);
		assoc['name'] = theName;
		assoc['error'] = jQuery.unob.getErrorMessage(rule);
		jQuery.unob.formErrors[jQuery.unob.cleanName(obj.name)] = assoc;
		jQuery.unob.formErrors.length++;
	},
	cleanName : function(nm){
		var parts = nm.split(jQuery.unob.validationSectionDelimiter);
		return parts[parts.length-1];
	},
	notifyErrors : function(){
		var str = 'There were error(s) in your submission.'+"\n";
		for(var i in jQuery.unob.formErrors){
			if(typeof(jQuery.unob.formErrors[i]['name'])!='undefined')
				str += '   • '+jQuery.unob.formErrors[i]['name']+': '+jQuery.unob.formErrors[i]['error']+"\n";
		}
		alert(str);
	},
	serializeForm : function(formObj){
		var myStr = '';
		var val = null;
		var count = 0;
		for(var i=0;i<formObj.length;i++){
			if(formObj[i].name!=''){
				val = this.getFieldValue(formObj[i]);
				if(val!=null){
					if(count!=0){myStr += '&';}
					myStr += formObj[i].name + '=' + val;
					count++;
				}
			}
		}
		alert('--'+myStr);
		return myStr;
	},
	getFieldValue : function(obj){
		var val = null;
		switch(obj.type){
			case 'radio':
				val = '';
				var nm = obj.name;
				var f = obj.form;
				for(var i=0;i<f[nm].length;i++){
					if(f[nm][i].checked) val=f[nm][i].value;
				}
				break;
			case 'checkbox':
				if(obj.checked==true){val=obj.value;}
				break;
			case 'select-one':
				val = obj.options[obj.selectedIndex].value;
				break;
			case 'hidden':
			case 'password':
			case 'submit':
			case 'text':
			case 'textarea':
			default:
				val = obj.value;
				break;
		}
		return val;
	},
	getRules : function(str){ return str.split(jQuery.unob.validationSectionDelimiter)[1].split(jQuery.unob.validationRuleDelimiter); },
	formRules : {
		eml : function(val){ var testStr = val.replace(/[^0-9]/g,'');return (testStr.length==9) ? true : false;},
		int : function(val){ return jQuery.unob.formRules.num(val);}, 
		num : function(val){ return val.length ? !isNaN(val.replace(/\s/,"z")/1) : true; }, 
		ph : function(val){ return /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/.test(val);}, 
		req : function(val){ return(typeof(val)!='undefined' && val!=null && val!='');},
		ssn : function(val){ var testStr = val.replace(/[^0-9]/g,'');return (testStr.length==9) ? true : false;} 
	},
	getErrorMessage : function(rule){
		switch(rule){
			case 'eml': return 'Not a valid email address.'; break;
			case 'ph': return 'Not a valid phone number.'; break;
			case 'num': return 'Is not numeric.'; break;
			case 'req': return 'Is required.'; break;
			default: return 'Invalid.'; break;
		}
	},
	
	/*Ajax Functions*/
	ajaxLinks : function(){
		jQuery('.ajax').click(function(){
			var dest = 	jQuery.unob.getNextClassName(this,'ajax');
			jQuery('#'+dest).html(jQuery.unob.loadingMsg);
			jQuery('#'+dest).load(jQuery.unob.markAjaxUrl(this.href),function(){jQuery.unob.initPage();});
			return false;
		});
	}, 
	ajaxLightbox : function(){
		jQuery('a.ajaxlightbox').each(function(){
			if(!jQuery(this).attr(jQuery.unob.iComp+'ajaxLightbox')){
				jQuery(this).click(function(){ jQuery.unob.lightboxUrl(this.href); return false; });
				jQuery(this).attr(jQuery.unob.iComp+'ajaxLightbox',true);
			}
		});
	},
	lightboxUrl : function(url){
		var dest = jQuery.unob.lightbox(jQuery.unob.loadingMsg);
		jQuery(dest).load(jQuery.unob.markAjaxUrl(url),function(){jQuery.unob.initPage();});
	},
	ajaxForm : function(f,callback){
		callback = callback || function(resp){};
		var arr = jQuery(f).map(function(){ return jQuery.makeArray(this.elements);});
		var arrObj = jQuery(arr).serializeArray();
		var meth = f.method.toLowerCase() || 'get';
		var act = f.action;
		switch(meth){
			case 'get':
			case 'post':
				jQuery[meth](act,arrObj,callback);
				break;
			default: break;
		}
		return false;
	},
	oneTimeAjax : function(){
		jQuery('a.ajaxonetime').each(function(){
			if(!jQuery(this).attr(jQuery.unob.iComp+'oneTimeAjax')){
				jQuery(this).click(function(){
					if(!jQuery(this).attr('oneTimeAjax_clicked')){
						var dest = 	jQuery.unob.getNextClassName(this,'ajaxonetime');
						jQuery(this).attr('oneTimeAjax_dest',dest);
						jQuery('#'+dest).html(jQuery.unob.loadingMsg);
						jQuery('#'+dest).slideDown();
						jQuery('#'+dest).load(jQuery.unob.markAjaxUrl(this.href),function(){jQuery.unob.initPage();});
						jQuery(this).attr('oneTimeAjax_clicked',true);
					} else {
						jQuery('#'+jQuery(this).attr('oneTimeAjax_dest')).slideToggle();
					}
					return false;
				});
				jQuery(this).attr(jQuery.unob.iComp+'oneTimeAjax',true);
			}
		});
	}
}; jQuery(document).ready(function(){jQuery.unob.initPage()}); 
jQuery.stackPageInit = function(func){ jQuery.unob.stackPageInit(func);};

/*Stack our own inits*/
jQuery.stackPageInit(jQuery.unob.checkAlls);
jQuery.stackPageInit(jQuery.unob.mouseovers);
jQuery.stackPageInit(jQuery.unob.classToggler);
jQuery.stackPageInit(jQuery.unob.displayToggler);
jQuery.stackPageInit(jQuery.unob.ajaxLinks);
jQuery.stackPageInit(jQuery.unob.ajaxLightbox);
jQuery.stackPageInit(jQuery.unob.oneTimeAjax);
jQuery(document).keypress(jQuery.unob.escapeLightbox);
jQuery.stackPageInit(jQuery.unob.initTooltip); 
jQuery.stackPageInit(jQuery.unob.validationInit);
