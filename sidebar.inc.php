<aside class="col-md-2">
    <br>
    <div id="accordion">
        <div class="card">
            <div class="card-header" >                
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                    Continents <span class="bi bi-caret-down-fill"></span>
                </a>
            </div>
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                    <ul class="list-group list-group-flush">
                        <?php $dbhandle->get_for_sidebar_continents(); ?>
                    </ul>
                </div>

            <div class="card-header" >
                <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                    Countries <span class="bi bi-caret-down-fill"></span>
                </a>
            </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <ul class="list-group list-group-flush">
                    <?php $dbhandle->get_for_sidebar_countries(); ?>
                    </ul>
                </div>

            <div class="card-header" >
                <a class="card-link" data-toggle="collapse" href="#collapseThree">
                    Cities <span class="bi bi-caret-down-fill"></span>
                </a>
            </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <ul class="list-group list-group-flush">
                            <?php $dbhandle->get_for_sidebar_cities(); ?>
                    </ul>
                </div>
        </div>
    </div>
</aside>
    
