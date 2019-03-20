
<div class="shadow-lg p-3 mb-5 ml-5 bg-white rounded" id="ads">
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php echo anchor("school/add-school/", "<i class='fas fa-edit'></i> Add School", "class='btn btn-info btn-sm p-left-10'", "style='padding-left:10px;'"); ?>
                
            </div>
        </div>
    </div>

    <div class=" table-responsive">
        <table class="table table-bordered" id="dataTable"  cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th> School Picture</th>
                    <th>School Name</th>
                    <th>Number of Boys</th>
                    <th>Number of Girls</th>
                    <th>Status</th>
                    <th colspan="4">Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>School Picture</th>
                    <th>School Name</th>
                    <th>Number of Boys</th>
                    <th>Number of Girls</th>
                    <th>Status</th>
                    <th colspan="4">Actions</th>
                </tr>
            </tfoot>
            
        </table>
    </div>
</div>
