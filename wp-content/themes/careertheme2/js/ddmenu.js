function switchpage(select) {
var index;
for(index=0; index<select.options.length; index++)
if(select.options[index].selected)
{
if(select.options[index].value!="")
window.location.href=select.options[index].value;
break;
}
}