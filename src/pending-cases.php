<div class="container">

    <h2>Pending Case's PDF's</h2>

    <table>
        <thead>
            <tr>
                <th>Docket Case Number</th>
                <th>Hearing Type</th>
                <th>Print</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../backend/config/database.config.php';
            $db = new Connection();
            $conn = $db->connect();

            $stmt = $conn->query("SELECT order_ID, Docket_Case_Number, Hearing, Status FROM GeneratedPDFs ORDER BY order_ID DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['Docket_Case_Number']}</td>
                        <td>{$row['Hearing']}</td>
                        <td><a href='../backend/getPDF.php?id={$row['order_ID']}' target='_blank'>View PDF</a></td>
                        <td>{$row['Status']}</td>
                        <td>
                            <button
                                class=\"open-status-modal\"
                                data-docket=\"{$row['Docket_Case_Number']}\" 
                                data-hearing=\"{$row['Status']}\"
                                >
                                Change Status
                            </button>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>

    <div id="status-modal" class="modal-overlay-status" style="display: none;">
        <div class="modal-content-status">
            <h3>Change Case Status</h3>
            <form id="status-form" action="../backend/changeStatus.php" method="post">
            <input type="hidden" name="docket_case_number" id="modal-docket">
            <div class="modal-actions-status">
                <button type="submit" name="status" value="Ongoing">Ongoing</button>
                <button type="submit" name="status" value="Dismissed">Dismissed</button>
                <button type="submit" name="status" value="Withdrawn">Withdrawn</button>
                <button type="submit" name="status" value="Settled">Settled</button>
                <button type="submit" name="status" value="CFA">CFA</button>
            </div>
            </form>
        </div>
    </div>

</div>
