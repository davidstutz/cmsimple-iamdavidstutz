<?php
 
/**
 * Generates the menu using bootstrap pills. Only the first level is used in navigation.
 * 
 * @return	string	html output
 */
function menu($level = NULL) {
    global $h, $l, $s;
  
    $html = '<ul class="nav nav-pills">' . "\n";
	foreach ($l as $index => $currentLevel)
	{
		if ($level !== NULL AND $level != $currentLevel)
		{
			continue;
		}
		
		if (hide($index))
		{
			continue;
		}
		
        // If the level is not 1, we only display the subpages of the current page on the given level.
        if ($level > 1 AND get_parent_page($index) != $s)
        {
            if (isset($l[$s]) AND $currentLevel != $l[$s] AND get_parent_page($s) != get_parent_page($index))
            {
                continue;
            }
        }
        
		if ($s == $index)
		{
			$html .= '<li class="active"><a href="#">' . $h[$index] . '</a></li>' . "\n";
		}
		else
		{
			$html .= '<li>' . a($index, '') . $h[$index] . '</a></li>' . "\n";
		}
	}
	$html .= '</ul>';
	
	return $html;
}

/**
 * Gets the parent page of the given page on the next higher level.
 * 
 * @param   integer index within $l
 * @return  integer id
 */
function get_parent_page($index) {
    global $l;
    
    // Start at the current position.
    $i = $index;
    
    // Go back while we are on the same level.
    do {
        $i--;
    } while (isset($l[$i]) AND $l[$i] == $l[$index]);
    
    return $i;
}

/**
 * Custom 404.
 */
function custom_404() {
    global $o, $title;
    
    $title = 'PAGENOTFOUND';
    $o = '<div class="dead-link">
        <h3>OOPS</h3>
        <h1 style="display:inline;">404</h1>
        <h3 style="display:inline;">
            PAGENOTFOUND
        </h3>
        <div>
            <h4>DEADLINK</h4>
        </div>
    </div>';
}
