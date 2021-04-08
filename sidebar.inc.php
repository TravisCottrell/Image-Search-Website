<div class="col-md-2" >
    <div class="card w-75 ml-auto">
        <div class="card-header" >Continents</div>
        <ul class="list-group">
            <?php $dbhandle->get_for_sidebar_continents(); ?>
        </ul>

        <div class="card-header" >Countries</div>
        <ul class="list-group">
        <?php $dbhandle->get_for_sidebar_countries(); ?>
        </ul>

        <div class="card-header" >Cities</div>
        <ul class="list-group">
                <?php $dbhandle->get_for_sidebar_cities(); ?>
        </ul>
    </div>
</div>
            



