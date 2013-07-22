<?php
class MyPager extends CLinkPager {

	const CSS_HIDDEN_PAGE='hidden';
	const CSS_SELECTED_PAGE='current';
	
	public function __construct() {
		$this->cssFile = Yii::app()->request->baseUrl.'/css/pager.css';
		$this->header = '';
		$this->prevPageLabel = Yii::t('general', 'prev');
		$this->nextPageLabel = Yii::t('general', 'next');
	}
	
//   	public function run()
// 	{
// 		// here we call our createPageButtons
// 		$buttons=$this->createPageButtons();

// 		// if there is nothing to display return
// 		if(empty($buttons))
// 			return;
		
// 		// display the buttons
// 		echo $this->header = ''; // if any
// 		echo CHtml::tag('ul',$this->htmlOptions,implode("\n",$buttons));
// 		echo $this->footer = ''; // if any
// 	}
	
	/**
	 * Creates a page button.
	 * You may override this method to customize the page buttons.
	 * @param string the text label for the button
	 * @param integer the page number
	 * @param string the CSS class for the page button. This could be 'page', 'first', 'last', 'next' or 'previous'.
	 * @param boolean whether this page button is visible
	 * @param boolean whether this page button is selected
	 * @return string the generated button
	 */
	protected function createPageButtons()
	{
		if(($pageCount=$this->getPageCount())<=1)
			return array();

		list($beginPage,$endPage)=$this->getPageRange();
		$currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
		$buttons=array();

		// first page
		//$buttons[]=$this->createPageButton($this->firstPageLabel,0,self::CSS_FIRST_PAGE,false,false);

		// prev page
		if(($page=$currentPage-1)<0)
			$page=0;
		$buttons[]=$this->createPageButton($this->prevPageLabel,$page,self::CSS_PREVIOUS_PAGE,$currentPage<=0,false);

		// internal pages
		for($i=$beginPage;$i<=$endPage;++$i)
			$buttons[]=$this->createPageButton($i+1,$i,self::CSS_INTERNAL_PAGE,false,$i==$currentPage);

		// next page
		if(($page=$currentPage+1)>=$pageCount-1)
			$page=$pageCount-1;
		$buttons[]=$this->createPageButton($this->nextPageLabel,$page,self::CSS_NEXT_PAGE,$currentPage>=$pageCount-1,false);

		// last page
		//$buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,self::CSS_LAST_PAGE,$endPage>=$pageCount-1,false);

		return $buttons;
	}
	
		/**
         * Creates the default pagination.
         * This is called by {@link getPages} when the pagination is not set before.
         * @return CPagination the default pagination instance.
         */
        protected function createPages()
        {
                return new MyPagination;
        }	
}