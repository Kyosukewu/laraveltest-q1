<div class="absolute inset-0 flex justify-center items-center" id="baseModal">
  <div class="shell w-4/6 h-1/2 bg-opacity-90 bg-white grid grid-rows-6">
    <div class="modal-header relative row-span-1 border-b">
      <h5 class="text-lg text-center pt-3">{{ $modal_header }}</h5>
      <button type="button" class="closeModal absolute right-2 top-2 text-gray-400 hover:text-gray-600">X</button>
    </div>
    <div class="modal-body row-span-4 text-center">
      <p>Modal body text goes here.</p>
    </div>
    <div class="modal-footer row-span-1 flex justify-center items-center">
      <button type="button" class="closeModal bg-gray-100 hover:bg-gray-200 w-14 h-7 rounded-md m-1">取消</button>
      <button type="button" class="bg-green-100 hover:bg-green-200 w-14 h-7 rounded-md m-1">儲存</button>
    </div>
  </div>
</div>
<script>
  $('.closeModal').on('click', function() {
    $("#baseModal").hide()
    $('#modal').html("")
  })
</script>