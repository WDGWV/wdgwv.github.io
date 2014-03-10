<?php
/*
                   :....................,:,              
                ,.`,,,::;;;;;;;;;;;;;;;;:;`              
              `...`,::;:::::;;;;;;;;;;;;;::'             
             ,..``,,,::::::::::::::::;:;;:::;            
            :.,,``..::;;,,,,,,,,,,,,,:;;;;;::;`          
           ,.,,,`...,:.:,,,,,,,,,,,,,:;:;;;;:;;          
          `..,,``...;;,;::::::::::::::'';';';:''         
          ,,,,,``..:;,;;:::::::::::::;';;';';;'';        
         ,,,,,``....;,,:::::::;;;;;;;;':'''';''+;        
         :,::```....,,,:;;;;;;;;;;;;;;;''''';';';;       
        `,,::``.....,,,;;;;;;;;;;;;;;;;'''''';';;;'      
        :;:::``......,;;;;;;;;:::::;;;;'''''';;;;:       
        ;;;::,`.....,::;;::::::;;;;;;;;'''''';;,;;,      
        ;:;;:;`....,:::::::::::::::::;;;;'''':;,;;;      
        ';;;;;.,,,,::::::::::::::::::;;;;;''':::;;'      
        ;';;;;.;,,,,::::::::::::::::;;;;;;;''::;;;'      
        ;'';;:;..,,,;;;:;;:::;;;;;;;;;;;;;;;':::;;'      
        ;'';;;;;.,,;:;;;;;;;;;;;;;;;;;;;;;;;;;:;':;      
        ;''';;:;;.;;;;;;;;;;;;;;;;;;;;;;;;;;;''';:.      
        :';';;;;;;::,,,,,,,,,,,,,,:;;;;;;;;;;'''';       
         '';;;;:;;;.,,,,,,,,,,,,,,,,:;;;;;;;;'''''       
         '''';;;;;:..,,,,,,,,,,,,,,,,,;;;;;;;''':,       
         .'''';;;;....,,,,,,,,,,,,,,,,,,,:;;;''''        
          ''''';;;;....,,,,,,,,,,,,,,,,,,;;;''';.        
           '''';;;::.......,,,,,,,,,,,,,:;;;''''         
           `''';;;;:,......,,,,,,,,,,,,,;;;;;''          
            .'';;;;;:.....,,,,,,,,,,,,,,:;;;;'           
             `;;;;;:,....,,,,,,,,,,,,,,,:;;''            
               ;';;,,..,.,,,,,,,,,,,,,,,;;',             
                 '';:,,,,,,,,,,,,,,,::;;;:               
                  `:;'''''''''''''''';:.                 
                                                         
 ,,,::::::::::::::::::::::::;;;;,::::::::::::::::::::::::
 ,::::::::::::::::::::::::::;;;;,::::::::::::::::::::::::
 ,:; ## ## ##  #####     ####      ## ## ##  ##   ##  ;::
 ,,; ## ## ##  ## ##    ##         ## ## ##  ##   ##  ;::
 ,,; ## ## ##  ##  ##  ##   ####   ## ## ##   ## ##   ;::
 ,,' ## ## ##  ## ##    ##    ##   ## ## ##   ## ##   :::
 ,:: ########  ####      ######    ########    ###    :::
 ,,,:,,:,,:::,,,:;:::::::::::::::;;;:::;:;:::::::::::::::
 ,,,,,,,,,,,,,,,,,,,,,,,,:,::::::;;;;:::::;;;;::::;;;;:::
                                                         
	     (c) WDGWV. 2013, http://www.wdgwv.com           
	 websites, Apps, Hosting, Services, Development.      

  File Checked.
  Checked by: WdG.
  File created: WdG.
  date: 07-06-2013

  © WDGWV, www.wdgwv.com
  All Rights Reserved.
*/

$dir = opendir('items');

$template = file_get_contents("http://www.wdgwv.com/placeholder");

$menu = ' <li><a href="#" onmouseover="mopen(\'open\')" onmouseout="mclosetime()">Open&nbsp;<b>&darr;</b></a>&nbsp;
                <div id="open" onmouseover="mcancelclosetime()" onmouseout="mclosetime()">'."\r\n";

while ( ( $file = readdir ( $dir ) ) !== false )
{
	if ($file != '.' && $file != '..')
	{
		$item = substr($file, 0, -5);
		$menu .= '<a href="'.$file.'">'.$item.'</a>'."\r\n";
	}
}
$menu .= '            	</div>
            </li>'."\r\n";

$dir = opendir('items');
while ( ( $file = readdir ( $dir ) ) !== false )
{
	if ($file != '.' && $file != '..')
	{
		echo "Generating " . $file . "\r\n";

		ob_start();
		include('items/' . $file);
		$open = ob_get_contents();
		ob_end_clean();

		$open = preg_replace("#{BACK}#",	 	null,  $open);
		$open = preg_replace("#{back}#",		null,  $open);

		$replace = $template;
		$replace = preg_replace("#PLACEHOLDER#", $open, 			 $replace);
		$replace = preg_replace("#<!--MENU-->#", $menu, 			 $replace);
		$replace = preg_replace("#&nbsp;WDGWV#", "&nbsp;Open WDGWV", $replace);

		//$menu[] = substr($file, 0, -5);

		$file = fopen($file, 'w');
		@fwrite($file, $replace);
		@fclose($file);
	}
}

/*
#FIX THE MENU
	ob_start();
	include('items/index.html');
	$open = ob_get_contents();
	ob_end_clean();
	
	$open    = preg_replace("#{BACK}#", "<a href='/index.html'>Back</a><hr /><br /><br />", $open);

	$menuTMP = null;
	for ($i=0; $i<sizeof($menu); $i++) 
	{ 
		$item = $menu[$i];
		$item = preg_replace("/_/", "&nbsp;", $item);
		
		$menuTMP .= "<a href=\"{$menu[$i]}.html\">{$item}</a>";

		if ($i < (sizeof($menu)-1) )
			$menuTMP .= "&nbsp;&nbsp;||&nbsp;&nbsp;";
	}

	$open    = preg_replace("#{MENU}#", $menuTMP, $open);
	$replace = $template;
	$replace = preg_replace("#PLACEHOLDER#", $open, $replace);
	$replace = preg_replace("#&nbsp;WDGWV#", "&nbsp;Open WDGWV", $replace);

	$file = fopen('index.html', 'w');
	@fwrite($file, $replace);
	@fclose($file);
*/

echo "All Files Created!\r\n\tDon't Wait!!!\r\n\r\n\t\tUPLOAD IT!!!\r\n\r\n";
?>