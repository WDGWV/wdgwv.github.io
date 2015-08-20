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
/*
							<li>
								<a href="https://www.wdgwv.com/dev:app">Website&nbsp;&darr;</a>
								<ul>
									<li><a href="https://www.wdgwv.com/lease:website">Lease</a></li>
                					<li><a href="https://www.wdgwv.com/dev:website">Website</a></li>
									<li><a href="https://www.wdgwv.com/dev:design">Design</a></li>
            						<li><a href="https://www.wdgwv.com/hosting">Hosting</a></li>
								</ul>
							</li>
*/
$menu = '<li><a href="#">Open&nbsp;&darr;</a><ul>';

while ( ( $file = readdir ( $dir ) ) !== false )
{
	if ($file != '.' && $file != '..')
	{
		$item = substr($file, 0, -5);
		$item = preg_replace("#_#", " ", $item);
		$menu .= '<li><a href="' . $file . '">' . $item . '</a></li>';
	}
}
$menu .= '</ul></li>';

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

		$open = preg_replace("#{BACK}#", "<a href='/index.html'>Back</a><hr /><br /><br />", $open);

		$item = substr($file, 0, -5);
		$item = preg_replace("#_#", " ", $item);

		$replace = $template;
		$replace = preg_replace("#Placeholder#", $item, $replace);
		$replace = preg_replace("#PLACEHOLDER#", $open, $replace);
		$replace = preg_replace("#<u><i><b></b></i></u>#", $menu, $replace);

		//$menu[] = substr($file, 0, -5);

		$file = fopen($file, 'w');
		@fwrite($file, $replace);
		@fclose($file);
	}
}

echo "All Files Created!\r\n\tDon't Wait!!!\r\n\r\n\t\tUPLOAD IT!!!\r\n\r\n";
?>