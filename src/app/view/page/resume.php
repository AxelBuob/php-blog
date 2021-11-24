<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <div class="h-100 d-flex flex-column flex-shrink-1 justify-content-between">
                <div>
                    <h1 class="text-uppercase"><?= $author->first_name . ' ' . $author->last_name; ?></h1>
                    <h2 class="text-uppercase fw-light lead text-muted"><?= $author->job; ?></h2>
                </div>
                <div class="mt-5">
                    <h3 class="text-uppercase">/ À propos de moi</h3>
                    <p><?= $author->about; ?></p>
                </div>
                <div class="mt-5">
                    <h3 class="text-uppercase">/ Compétences</h3>
                    <ul class="list-unstyled list-inline">
                        <?php foreach ($skills as $skill) : ?>
                            <li class="list-inline-item py-2"><i class="<?= $skill->class; ?> fa-2x"><span class="d-none"><?= $skill->name; ?></span></i></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="mt-5">
                    <h3 class="text-uppercase">/ Intérêts</h3>
                    <ul class="list-unstyled">
                        <?php foreach ($interests as $interest) : ?>
                            <li>>> <?= $interest->name;  ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <h3>/ Expériences</h3>
                <ul class="list-unstyled">
                    <?php foreach ($experiences as $experience) : ?>
                        <li>
                            <span class="text-uppercase fw-bold"><?= $experience->start_date; ?> à <?= $experience->end_date; ?></span>
                            <br>
                            <span class="fw-light">>> <?= $experience->name; ?> // <?= $experience->company; ?> // <?= $experience->postcode; ?> <?= $experience->city; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h3 class="mt-5">/ Formation</h3>
                <ul class="list-unstyled">
                    <?php foreach ($formations as $formation) : ?>
                        <li>
                            <span class="text-uppercase fw-bold"><?= $formation->start_date; ?> à <?= $formation->end_date; ?></span>
                            <br>
                            <span class="fw-light">>> <?= $formation->name; ?> // <?= $formation->school; ?> // <?= $experience->postcode; ?> <?= $experience->city; ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div id="resume-download" class="d-flex justify-content-center mt-5">
        <a href="/portofolio/page/resume/?download" class="btn btn-outline-dark text-uppercase">Télécharger</a>
    </div>
</div>
