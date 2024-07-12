<!-- View Employee Modal -->
<div class="modal fade" id="viewEmpModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <div class="modal-title">
                    <h5>Employees List</h5>
                </div>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT * FROM users";
                        $que = mysqli_query($con, $sql);
                        $cnt = 1;
                        while ($result = mysqli_fetch_assoc($que)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['department']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td>
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="employee_id" value="<?php echo $result['id']; ?>">
                                    <button type="submit" class="btn btn-danger" style="border-radius:0%;">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php $cnt++; }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
