<div id="navigation-wrapper" class="side-column">
    <h2>Navigation</h2>
    <nav class="bgwhite padding20" id="project-navigation">
        <a href="index.php?r=developer/projectinfo&id=<?php echo $model->projectId; ?>" class="nav-title"><?php echo $model->title; ?></a>
        <ul class="hierarchy">
            <?php if ($model->todo) { ?>
            <li>
                <span>Todos</span>
                <ul>
                    <?php foreach ($model->todo as $todo) { ?>
                    <li>
                        <a href="index.php?r=developer/todo&id=<?php echo $todo->todoId; ?>"><?php echo $todo->title; ?></a>
                    </li>  
                     <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <?php if ($model->mindmap->projectId) { ?>
            <li>
                <a href="http://tandmtracker:8080/index.php?r=developer/mindmap&id=<?php echo $model->mindmap->projectId; ?>">Mindmap</a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>