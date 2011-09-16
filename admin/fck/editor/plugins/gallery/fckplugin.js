// Define the command.

var FCKWojo = function( name )
{
	this.Name = name ;
	this.EditMode = FCK.EditMode;
}

FCKWojo.prototype.Execute = function()
{
	switch ( this.Name )
	{
		case 'Gallery' :
			var oPageBreak = FCK.InsertHtml('[%%GALLERYFOLDER%%]') ;
			break;
		default :
	}
}

FCKWojo.prototype.GetState = function()
{
	return FCK_TRISTATE_OFF ;
}

// Register the Wojo tag commands.
FCKCommands.RegisterCommand( 'WojoGallery', new FCKWojo( 'Gallery' ) ) ;

// Create the Wojo tag buttons.
var oWojoItem = new FCKToolbarButton( 'WojoGallery', 'Gallery', null, FCK_TOOLBARITEM_ONLYICON, true, true ) ;
oWojoItem.IconPath = FCKConfig.PluginsPath + 'gallery/gallery.png';
FCKToolbarItems.RegisterItem( 'WojoGallery', oWojoItem ) ;