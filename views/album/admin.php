<?php
/* @var $this AlbumController */
/* @var $model Album */

$this->menu = [
    [
      'label' => 'List Album',
      'url' => ['/album/index','uguid'=>$user->guid]
    ],
    [
      'label' => 'Create Album',
      'url' => ['/album/create','uguid'=>$user->guid],
    ],
    [
      'label' => 'Manage Albums',
      'url' => '#',
      'active' => true
    ],
];

Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#album-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Albums</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', [
    'id'=>'album-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>[
        'id',
        'name',
        'description',
        [
        	'header' => 'Created',
        	'value' => 'HHtml::timeAgo($data->created_at)',
        	'type'=>'html'
        ],
        [
        	'header' => 'Updated',
        	'value' => 'HHtml::timeAgo($data->updated_at)',
        	'type'=>'html'
        ],
        /*
        'created_by',
        'updated_by',
        */
        [
            'class'=>'CButtonColumn',
            'viewButtonUrl' => '["/album/view","id"=>$data->id,"uguid"=>$data->owner->guid]',
            'updateButtonUrl' => '["/album/update","id"=>$data->id,"uguid"=>$data->owner->guid]',
            'deleteButtonUrl' => '["/album/delete","id"=>$data->id,"uguid"=>$data->owner->guid]'
        ],
    ],
]); 
?>
