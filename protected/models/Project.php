<?php

/**
 * This is the model class for table "tbl_project".
 *
 * The followings are the available columns in table 'tbl_project':
 * @property integer $projectId
 * @property string $start
 * @property string $end
 * @property string $title
 * @property string $description
 * @property string $modified
 * @property string $status
 * @property Todo[] $todo
 * @property Mindmap $mindmap
 */
class Project {

    public function __construct(tblProject $project, $todo = null, $mindmap = null) {
        $this->description = $project->description;
        $this->end = $project->end;
        $this->modified = $project->modified;
        $this->projectId = $project->projectId;
        $this->start = $project->start;
        $this->status = $project->status;
        $this->title = $project->title;
        $this->todo = $todo;
        $this->mindmap = $mindmap;
    }



}
