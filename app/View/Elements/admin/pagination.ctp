<?php $this->Paginator->options(array('url'=>Router::getParam('pass'))); ?>
<div class="paging">
<?php
	if($this->Paginator->hasPrev())
		echo $this->Paginator->prev('Prev', array('escape'=>false), null, array('escape'=>false));

	if(is_string($this->Paginator->numbers()))
		echo $this->Paginator->numbers(array('separator' =>'','before' =>'&nbsp;','after'=>'&nbsp;'));

	if($this->Paginator->hasNext())
		echo $this->Paginator->next('Next', array('escape'=>false), null, array('escape'=>false));
?>
</div>
<div class="clr"></div>