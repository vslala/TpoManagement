<?php
$title = "Comapnies";
$setCompanyActive = "active";
$success = NULL; $error=NULL;

require_once "php/DBConnect.php";
$db = new DBConnect();
$companies = $db->selectAllFromCompanies();

include 'layout/_header.php';

include 'layout/_top_nav.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <a href="addCompany.php" class="btn btn-success btn-lg">Add Company</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <th>Index</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Fax</th>
                    <th>Ceo</th>
                </thead>
                <tbody>
                    <?php if(isset($companies)): $i=0; ?>
                        <?php foreach($companies as $c): $i++; ?>
                    <tr class="<?php if($i%2==0){echo 'bg-success';}else{echo 'bg-info';} ?>" >
                        <td><?= $i; ?></td>
                        <td><?= $c['c_name']; ?></td>
                        <td><?= $c['c_address']; ?></td>
                        <td><?= $c['email']; ?></td>
                        <td><?= $c['mobile']; ?></td>
                        <td><?= $c['fax']; ?></td>
                        <td><?= $c['ceo']; ?></td>
                        <td><a href="editCompany.php?id=<?= $c['id']; ?>" >edit</a></td>
                        <td><a href="deleteCompany.php?id=<?= $c['id']; ?>">delete</a></td>
                    </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr class="bg-danger">
                        <td>There is no information present in the database.</td>
                    </tr>
                    
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'layout/_footer.php'; ?>
