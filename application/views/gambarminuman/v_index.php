<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Gambar Minuman
                </div>
              </div>
              <div class="card-body">
                
					<?php $no = 1;
					foreach ($gambarminuman as $key => $value) { ?>
						
							<img src="<?= base_url('assets/gambar/' . $value->gambar) ?>" width="300px">
							
									
						
					<?php } ?>

				</tbody>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>
