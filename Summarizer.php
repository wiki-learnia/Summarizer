<?php
# Alert the user that this is not a valid access point to MediaWiki if they try to access the special pages file directly.
if ( !defined( 'MEDIAWIKI' ) ) {
        echo <<<EOT
To install my extension, put the following line in LocalSettings.php:
require_once( "\$IP/extensions/Summarizer/Summarizer.php" );
EOT;
        exit( 1 );
}
 
$wgExtensionCredits[ 'specialpage' ][] = array(
        'path' => __FILE__,
        'name' => 'Summarizer',
        'author' => 'wiki-learia team',
        'url' => '',
        'descriptionmsg' => 'summarizer',
        'version' => '2.0',
);

$wgResourceModules['ext.Summarizer'] = array(
	'scripts' => 'ext.Summarizer.js',
        'styles' => 'ext.Summarizer.css',
 
        // You need to declare the base path of the file paths in 'scripts' and 'styles'
        'localBasePath' => __DIR__,
        // ... and the base from the browser as well. For extensions this is made easy,
        // you can use the 'remoteExtPath' property to declare it relative to where the wiki
        // has $wgExtensionAssetsPath configured:
        'remoteExtPath' => 'Summarizer'
); 
$wgAutoloadClasses[ 'SpecialSummarizer' ] = __DIR__ . '/SpecialSummarizer.php'; # Location of the SpecialMyExtension class (Tell MediaWiki to load this file)
$wgExtensionMessagesFiles[ 'Summarizer' ] = __DIR__ . '/Summarizer.i18n.php'; # Location of a messages file (Tell MediaWiki to load this file)
$wgExtensionMessagesFiles[ 'SummarizerAlias' ] = __DIR__ . '/Summarizer.alias.php'; # Location of an aliases file (Tell MediaWiki to load this file)
$wgSpecialPages[ 'Summarizer' ] = 'SpecialSummarizer'; # Tell MediaWiki about the new special page and its class name
$wgHooks['SkinBuildSidebar'][] = 'fnSidebar';


function fnSidebar( $skin, &$bar ) {
global $wgServer,$wgScriptPath,$wgUser;

	$marker= "WLmarker".$wgUser->getId();


        $out = "                 var content = window.getSelection().getRangeAt(0).cloneContents();
                                div = document.createElement('div');
                                div.appendChild(content);
                                if (!localStorage.getItem('".$marker."')) {
                                    localStorage.setItem('".$marker."','');
                                }
                                localStorage.setItem('".$marker."', localStorage.getItem('".$marker."') + div.innerHTML);";

        $bar['Summarizer'][0]['text'] = wfMessage('addsummary');
	$bar['Summarizer'][0]['href'] = "javascript:".$out;

        $bar['Summarizer'][1]['text'] = wfMessage('showsummary');
        $bar['Summarizer'][1]['href'] = $wgServer.$wgScriptPath.'/index.php/Spezial:Summarizer';


        return true;
}

