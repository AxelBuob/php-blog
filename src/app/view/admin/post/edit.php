<?php var_dump($post); ?>
<div class="container my-5">
    <form method="post">
        <?= $form->input('name', "Titre"); ?>
        <?= $form->input('content', 'Contenu', '', ['type' => 'textarea']); ?>
        <?= $form->select('post_category', 'Catégorie', $categories); ?>
        <?= $form->select('post_status', 'Status', $status); ?>
        <?= $form->submit('Enregistrer'); ?>
    </form>
</div>
<script src="https://cdn.tiny.cloud/1/us6lu5txassmmez5y0vq3ber24e0ksic4auvdrcrpbreywwf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        // plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        // toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
        // toolbar_mode: 'floating',
    });
</script>