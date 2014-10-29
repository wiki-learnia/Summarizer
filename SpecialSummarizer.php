<?php
class SpecialSummarizer extends SpecialPage {
	function __construct() {
		 parent::__construct( 'Summarizer' );
	}

	function execute( $par ) {
	global $wgRequest, $wgOut;

		$this->setHeaders();
		$this->displayForm();
	}




	function displayForm() {
	global $wgOut, $wgScript, $wgTitle, $wgUser, $wgScriptPath, $wgExtensionAssetsPath;

		$marker= "WLmarker".$wgUser->getId();

		//display help
		$html = "<div id='summaryhel' class='noprint'>".wfMessage("summaryhelp");
		$html.= "</div>";
		$html.= "<img src='".$wgExtensionAssetsPath."/Summarizer/summarizer.PNG' alt='context menu' class='noprint'>";
		$html.= "<div class='noprint'>";
		$html.= wfMessage("summaryhelp2");
		$html.= '</div>';

		//display summary
		$html .= '<div id="summarycontainer"></div>';

		$wgOut->addHTML($html);
		$wgOut->addModules('ext.Summarizer');

	}

}
