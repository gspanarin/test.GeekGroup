<li class="d-flex justify-content-between mb-4">
            <div class="card w-100">
              <div class="card-header d-flex justify-content-between p-3">
                <p class="fw-bold mb-0">USER: <?= $model->user_id?></p>
                <p class="text-muted small mb-0"><i class="far fa-clock"></i><?= date('Y-m-d H-i', $model->created_at)?></p>
              </div>
              <div class="card-body">
                <p class="mb-0">
                  <?= $model->text?>
                </p>
              </div>
            </div>
            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
              class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
          </li>
          