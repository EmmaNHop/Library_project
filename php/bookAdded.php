  <!-- Modal -->
  <div class="modal fade" id="noticeModal" tabindex="-1" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Added class 'modal-dialog-centered' -->
      <div class="modal-content bg-dark text-white">
        <div class="modal-header border-0">
          <h5 class="modal-title" id="noticeModalLabel">Notice</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="noticeMessage"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  
  <!-- JavaScript to Show Modal on Page Load -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var message = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>";
        if (message) {
          var noticeModal = new bootstrap.Modal(document.getElementById('noticeModal'));
          noticeModal.show(); // Automatically show the modal

          <?php unset($_SESSION['message']); ?>
        }
    });
  </script>
