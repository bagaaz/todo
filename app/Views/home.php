<?php foreach ($tasks as $task): ?>
    <li class="app_body__list-item <?= $task['checked'] ? 'checked' : '' ?>" data-id="<?= $task['id'] ?>" data-position="<?= $task['position'] ?>">
        <!-- <i class="bi bi-grip-vertical"></i> -->
        <div class="app_body__list-item__task">
            <p><?= $task['task'] ?></p>
        </div>
        <div class="app_body__list-item__actions">
            <?php if (!$task['checked']): ?>
            <button class="app_body__list-item__actions__check-button" onclick="checkTask(<?= $task['id'] ?>)"><i class="bi bi-check-lg"></i></button>
            <button class="app_body__list-item__actions__edit-button" onclick="editTask(<?= $task['id'] ?>)"><i class="bi bi-pen"></i></button>
            <?php endif; ?>
            <button class="app_body__list-item__actions__delete-button" onclick="deleteTask(<?= $task['id'] ?>)"><i class="bi bi-x-lg"></i></button>
        </div>
    </li>

<?php endforeach; ?>