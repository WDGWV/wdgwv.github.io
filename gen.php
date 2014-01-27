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

$menu = array();

while ( ( $file = readdir ( $dir ) ) !== false )
{
	if ($file != '.' && $file != '..')
	{
		echo "Generating " . $file . "\r\n";

		$open = file_get_contents('items/' . $file);
		$open = preg_replace("#{BACK}#", "<a href='/index.html'>Back</a><hr /><br /><br />", $open);

		$replace = $template;
		$replace = preg_replace("#PLACEHOLDER#", $open, $replace);
		$replace = preg_replace("#&nbsp;WDGWV#", "&nbsp;Open WDGWV", $replace);

		$menu[] = substr($file, 0, -5);

		$file = fopen($file, 'w');
		@fwrite($file, $replace);
		@fclose($file);
	}
}

#FIX THE MENU
	$open    = file_get_contents('items/index.html');
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

echo "All Files Created!\r\n\tDon't Wait!!!\r\n\r\n\t\tUPLOAD IT!!!";
?>