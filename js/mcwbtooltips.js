jQuery(document).ready(function () {

jQuery("a[href*=minecraftwb]").each(function () {
var href = jQuery(this).attr("href");
var hrefsplit = href.split("game-database/");
if (hrefsplit.length > 1) {
var tag = hrefsplit[1].replace(/\//g,'_');
jQuery(this).addClass(tag);
var obj = jQuery(this);
jQuery.get('/wp-content/plugins/minecraft-workbench-tooltips/tooltips.php?tag='+tag, function (data) {
mcwbMakeTooltip(obj,data);
});
}
});

});

function mcwbMakeTooltip(obj, data) {
classname = obj.attr('class');
href = obj.attr('href');
label = obj.html();
newhtmltag = "<span class='"+classname+"'><a href='"+href+"' target='_blank'>"+label+"</a></span>";
obj.replaceWith(newhtmltag);
jQuery("."+classname).simpletip({
content: data
});
}
