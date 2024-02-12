<?php $itemCount += 1 ?>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button
                class="accordion-button collapsed <?= !$reserva["atualizadoEm"] ? "bg-warning" : "bg-primary bg-opacity-10" ?>"
                type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?= $reserva["idreserva"] ?>"
                aria-expanded="false" aria-controls="flush-<?= $reserva["idreserva"] ?>">
                Reserva nº
                <?= $reserva["idreserva"] ?> |
                <?= $reserva["atualizadoEm"] ?
                  date("d/m H:i", strtotime($reserva["atualizadoEm"]))
                  : date("d/m H:i", strtotime($reserva["criadoEm"]))
                  ?>
              </button>
            </h2>
            <div id="flush-<?= $reserva["idreserva"] ?>"
              class="accordion-collapse collapse  border-bottom border-start border-end">
              <div class="d-flex flex-column accordion-body" data-bs-parent="#accordion-reserva">
                <h4 class="m-0">
                  <i class="ri-user-4-line"></i>
                  <?= $reserva["username"] ?>
                </h4>
                <span class="text-muted">
                  <i class="ri-door-open-line"></i>
                  <?= $reserva["roomname"] ?> |
                  <?php
                  switch ($reserva["periodo"]):
                    case "Manhã":
                      echo "<i class='ri-sun-line'></i> " . $reserva["periodo"];
                      break;
                    case "Tarde":
                      echo "<i class='ri-sun-foggy-line'></i> " . $reserva["periodo"];
                      break;
                    case "Noite":
                      echo "<i class='ri-moon-line'></i> " . $reserva["periodo"];
                      break;
                  endswitch ?>
                </span>
                <span class="text-muted">
                  <i class="ri-key-line"></i>
                  <?= date("d/m H:i", strtotime($reserva["criadoEm"])) ?>
                </span>
                <span class="text-muted">
                  <i class="ri-corner-down-right-line"></i>
                  <?= !$reserva["atualizadoEm"] ? "Pendente" : date("d/m H:i", strtotime($reserva["atualizadoEm"])) ?>
                </span>
              </div>
            </div>
          </div>