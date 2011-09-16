<?php

/**
 * HTMLHelpers class
 */

class HTML {

    /**
     * Constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {
	
    }

    /**
     * Doctype
     *
     * Generates a page document type declaration
     *
     * Valid options are xhtml-11, xhtml-strict, xhtml-trans, xhtml-frame,
     * html4-strict, html4-trans, and html4-frame.  Values are saved in the
     * doctypes config file.
     *
     * @access	public
     * @param	string	type The doctype to be generated
     * @return	string
     */
    
    public function doctype($type = 'xhtml1-strict') {

	global $_doctypes;

	if ( ! is_array($_doctypes)) {

	    if ( ! require_once(ADMINPATH . '/core/doctypes.php')) {

		return FALSE;
	    }
	}

	if (isset($_doctypes[$type])) {

	    return $_doctypes[$type];
	}
	else {

	    return FALSE;
	}
    }
	/**
     * Heading
     *
     * Generates an HTML heading tag.  First param is the data.
     * Second param is the size of the heading tag.
     *
     * @access	public
     * @param	string
     * @param	integer
     * @return	string
     */
    
    public function title( $title ) {
	
		return '<title> '. $title .'</title>';
    }
    /**
     * Heading
     *
     * Generates an HTML heading tag.  First param is the data.
     * Second param is the size of the heading tag.
     *
     * @access	public
     * @param	string
     * @param	integer
     * @return	string
     */
    
    public function heading( $data = '', $h = '1' ) {
	
		return '<h'.$h.'>'.$data.'</h'.$h.'>';
    }

    /**
     * Unordered List
     *
     * Generates an HTML unordered list from an single or multi-dimensional array.
     *
     * @access	public
     * @param	array
     * @param	mixed
     * @return	string
     */

    public function ul( $list, $attributes = '' ) {
	
	return $this->_list('ul', $list, $attributes);
    }


    /**
     * Generates non-breaking space entities based on number supplied
     *
     * @access	public
     * @param	integer
     * @return	string
     */
    public function nbs($num = 1) {

	return str_repeat("&nbsp;", $num);
    }
    
    /**
     * Ordered List
     *
     * Generates an HTML ordered list from an single or multi-dimensional array.
     *
     * @access	public
     * @param	array
     * @param	mixed
     * @return	string
     */
    public function ol( $list, $attributes = '' ) {

	return $this->_list('ol', $list, $attributes);
    }

    /**
     * Generates the list
     *
     * Generates an HTML ordered list from an single or multi-dimensional array.
     *
     * @access	private
     * @param	string
     * @param	mixed
     * @param	mixed
     * @param	integer
     * @return	string
     */
    private function _list( $type = 'ul', $list, $attributes = '', $depth = 0 ) {

	// If an array wasn't submitted there's nothing to do...
	if ( ! is_array($list) ) {

	    return $list;
	}

	// Set the indentation based on the depth
	$out = str_repeat(" ", $depth);

	// Were any attributes submitted?  If so generate a string
	if (is_array($attributes)) {
	    
	    $atts = '';

	    foreach ($attributes as $key => $val) {

		    $atts .= ' ' . $key . '="' . $val . '"';
	    }

	    $attributes = $atts;
	}

	// Write the opening list tag
	$out .= "<".$type.$attributes.">\n";

	// Cycle through the list elements.  If an array is
	// encountered we will recursively call _list()

	static $_last_list_item = '';
	
	foreach ($list as $key => $val) {
	    
	    $_last_list_item = $key;

	    $out .= str_repeat(" ", $depth + 2);
	    $out .= "<li>";

	    if ( ! is_array($val)) {

		    $out .= $val;
	    }
	    else {
		    $out .= $_last_list_item."\n";
		    $out .= _list($type, $val, '', $depth + 4);
		    $out .= str_repeat(" ", $depth + 2);
	    }

	    $out .= "</li>\n";
	}

	// Set the indentation for the closing tag
	$out .= str_repeat(" ", $depth);

	// Write the closing list tag
	$out .= "</".$type.">\n";

	return $out;
    }

    /**
     * Generates HTML BR tags based on number supplied
     *
     * @access	public
     * @param	integer
     * @return	string
     */
    public function br($num = 1) {

	return str_repeat('<br />', $num);
    }

    /**
     * Image
     *
     * Generates an <img /> element
     *
     * @access	public
     * @param	mixed
     * @return	string
     */
    public function img( $src = '', $index_page = FALSE ) {

	if ( ! is_array($src) ) {

	    $src = array('src' => $src);
	}

	// If there is no alt attribute defined, set it to an empty string
	if ( ! isset($src['alt'])) {

		$src['alt'] = '';
	}

	$img = '<img';

	foreach ($src as $k=>$v) {


	    if ($k == 'src' AND strpos($v, '://') === FALSE) {

		if ($index_page === TRUE) {

			$img .= ' src="'.BASEADMINURL.$v.'"';
		}
		else {
			$img .= ' src="'.BASEURL.$v.'"';
		}
	    }
	    else {
		    $img .= " $k=\"$v\"";
	    }
	}

	$img .= '/>';

	return $img;
    }
    
    /**
     * Link
     *
     * Generates link to a CSS file
     *
     * @access	public
     * @param	mixed	stylesheet hrefs or an array
     * @param	string	rel
     * @param	string	type
     * @param	string	title
     * @param	string	media
     * @param	boolean	should index_page be added to the css path
     * @return	string
     */
    public function link( $href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = false ) {

	$link = '<link ';

	if (is_array($href)) {

	    foreach ($href as $k=>$v) {

		if ($k == 'href' AND strpos($v, '://') === FALSE) {

		    if ($index_page === TRUE) {
			$link .= 'href="'.$v.'" ';
		    }
		    else {
			$link .= 'href="'.$v.'" ';
		    }
		}
		else {
		    $link .= "$k=\"$v\" ";
		}
	    }

	    $link .= "/>";
	}
	else {
	    
	    if ( strpos($href, '://') !== FALSE) {

		$link .= 'href="'.$href.'" ';
	    }
	    elseif ($index_page === TRUE) {
		
		$link .= 'href="'.$href.'" ';
	    }
	    else {

		$link .= 'href="'.$href.'" ';
	    }

	    $link .= 'rel="'.$rel.'" type="'.$type.'" ';

	    if ($media	!= '') {

		$link .= 'media="'.$media.'" ';
	    }

	    if ($title	!= '') {

		$link .= 'title="'.$title.'" ';
	    }

	    $link .= '/>';
	}

	return $link;
    }

    /**
     * Scripts
     *
     * Generates scripts to a javascript file
     *
     * @access	public
     * @param	mixed	stylesheet hrefs or an array
     * @param	string	rel
     * @param	string	type
     * @param	string	title
     * @param	string	media
     * @param	boolean	should index_page be added to the css path
     * @return	string
     */

    public function scripts($src = '', $type = 'text/javascript', $index_page = FALSE) {

	    $script = '<script';

		if (is_array($src)) {

		    foreach ($src as $k=>$v) {

			if ($k == 'src' AND strpos($v, '://') === FALSE)
			{
			    if ($index_page === TRUE)
			    {
				$script .= ' src="'.BASEURL.$v.'" ';
			    }
			    else
			    {
				$script .= ' src="'.BASEURL.$v.'" ';
			    }
			}
			else
			{
			    $script .= "$k=\"$v\" ";
			}
		    }

		$script .= "></script>";
	    }
	    else {
		if ( strpos($src, '://') !== FALSE)
		{
		    $script .= ' src="'.BASEURL.$src.'" ';
		}
		elseif ($index_page === TRUE)
		{
		    $script .= ' src="'.BASEURL.$src.'" ';
		}
		else
		{
		    $script .= ' src="'.BASEURL.$src.'" ';
		}

		$script .= 'type="'.$type.'"';

		$script .= '></script> ';
	    }

	    return $script;
    }
    
    /**
     * Generates meta tags from an array of key/values
     *
     * @access	public
     * @param	array
     * @return	string
     */
    public function meta( $name = '', $content = '', $type = 'name', $newline = "\n" ) {
	// Since we allow the data to be passes as a string, a simple array
	// or a multidimensional one, we need to do a little prepping.
	if ( ! is_array($name)) {
	    $name = array(array('name' => $name, 'content' => $content, 'type' => $type, 'newline' => $newline));
	}
	else {
	    // Turn single array into multidimensional
	    if (isset($name['name'])) {
		    $name = array($name);
	    }
	}

	$str = '';
	foreach ($name as $meta) {
	    
	    $type		= ( ! isset($meta['type']) OR $meta['type'] == 'name') ? 'name' : 'http-equiv';
	    $name		= ( ! isset($meta['name']))		? ''	: $meta['name'];
	    $content	= ( ! isset($meta['content']))	? ''	: $meta['content'];
	    $newline	= ( ! isset($meta['newline']))	? "\n"	: $meta['newline'];

	    $str .= '<meta '.$type.'="'.$name.'" content="'.$content.'" />'.$newline;
	}

	return $str;
    }
	

    /**
     * Parse out the attributes
     *
     * Some of the functions use this
     *
     * @access	private
     * @param	array
     * @param	bool
     * @return	string
     */
    private function parse_attributes( $attributes, $javascript = FALSE ) {

	if (is_string($attributes)) {

		return ($attributes != '') ? ' '.$attributes : '';
	}

	$att = '';

	foreach ($attributes as $key => $val) {

	    if ($javascript == TRUE) {
		    $att .= $key . '=' . $val . ',';
	    }
	    else {
		    $att .= ' ' . $key . '="' . $val . '"';
	    }
	}

	if ( $javascript == TRUE AND $att != '' ) {
		$att = substr($att, 0, -1);
	}

	return $att;
    }
    
    /**
     * Link
     *
     * Creates an anchor based on the local URL.
     *
     * @access	public
     * @param	string	the URL
     * @param	string	the link title
     * @param	mixed	any attributes
     * @return	string
     */
    public function url($uri = '', $title = '', $attributes = '') {

	$title = (string) $title;

	if ( !is_array($uri)) {

	    $site_url = ( !preg_match('!^\w+://! i', $uri)) ? BACK_END_URL.$uri : $uri; //BACK_END_URL
	}
	else {

	    $site_url = 'javascript:void(0)';
	}

	if ($title == '') {

	    $title = $site_url;
	}

	if ($attributes != '') {

	    $attributes = $this->parse_attributes($attributes);
	}

	return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
    }


    /**
     * Anchor Link - Pop-up version
     *
     * Creates an anchor based on the local URL. The link
     * opens a new window based on the attributes specified.
     *
     * @access	public
     * @param	string	the URL
     * @param	string	the link title
     * @param	mixed	any attributes
     * @return	string
     */

    public function url_popup( $uri = '', $title = '', $attributes = FALSE ) {
	
	$title = (string) $title;

	$site_url = ( ! preg_match('!^\w+://! i', $uri)) ? site_url($uri) : $uri;

	if ($title == '') {
	    $title = $site_url;
	}

	if ($attributes === FALSE) {
	    return "<a href='javascript:void(0);' onclick=\"window.open('".$site_url."', '_blank');\">".$title."</a>";
	}

	if ( ! is_array($attributes)) {
	    $attributes = array();
	}

	foreach (array('width' => '800', 'height' => '600', 'scrollbars' => 'yes', 'status' => 'yes', 'resizable' => 'yes', 'screenx' => '0', 'screeny' => '0', ) as $key => $val) {
	    $atts[$key] = ( ! isset($attributes[$key])) ? $val : $attributes[$key];
	    unset($attributes[$key]);
	}

	if ($attributes != '') {
	    
	    $attributes = $this->parse_attributes($attributes);
	}

	return "<a href='javascript:void(0);' onclick=\"window.open('".$site_url."', '_blank', '".$this->parse_attributes($atts, TRUE)."');\"$attributes>".$title."</a>";

    }


    /**
     * Mailto Link
     *
     * @access	public
     * @param	string	the email address
     * @param	string	the link title
     * @param	mixed	any attributes
     * @return	string
     */
    public function mailto( $email, $title = '', $attributes = '' ) {

	$title = (string) $title;

	if ($title == "") {
		$title = $email;
	}

	$attributes = $this->parse_attributes($attributes);

	return '<a href="mailto:'.$email.'"'.$attributes.'>'.$title.'</a>';
    }
    
    /**
     * Mailto Link
     *
     * @access	public
     * @param	string	the email address
     * @param	string	the link title
     * @param	mixed	any attributes
     * @return	string
     */
    public function clear_url( $link, $title = '', $attributes = '' ) {

	$title = (string) $title;

	if ($title == "") {
		$title = $link;
	}
	elseif ($link == "") {
		$link = 'javascript:void(0)';
	}

	$attributes = $this->parse_attributes($attributes);

	return '<a href="'.$link.'"'.$attributes.'>'.$title.'</a>';
    }

    /**
     * End Class
     */
}