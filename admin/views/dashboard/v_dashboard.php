<main>
    <section class="box m-1 p-2 p-md-4">
        <p class="font-weight-bold mb-1 mb-md-2">Thống kê bài viết</p>
        <div id="dashboard_article" class="flex-center"><span class='spinner-border my-5'></span></div>
        <hr class="my-1 my-md-3">
        <p class="font-weight-bold mb-1 mb-md-2">Thống kê CTKM</p>
        <div id="dashboard_project" class="flex-center"><span class='spinner-border my-5'></span></div>
        <hr class="my-1 my-md-3">
    </section>
</main>
<script>
  const options = {legend: {labels: {fontColor: "black"}},scales: {yAxes: [{ticks: {beginAtZero: true,fontColor: "black"}}],xAxes: [{ticks: {fontColor: "black"}}]}};
  const arr_color = ["#007bff", "#ffc107", "#28a745", "#dc3545", "#fd7e14", "#e83e8c","#007bff", "#ffc107", "#28a745", "#dc3545", "#fd7e14", "#e83e8c","#007bff", "#ffc107", "#28a745", "#dc3545", "#fd7e14", "#e83e8c","#007bff", "#ffc107", "#28a745", "#dc3545", "#fd7e14", "#e83e8c"];
  const arr_color_opacity = ["#007bff94", "#ffc10794", "#28a74594", "#dc354594", "#fd7e1494", "#e83e8c94","#007bff94", "#ffc10794", "#28a74594", "#dc354594", "#fd7e1494", "#e83e8c94","#007bff94", "#ffc10794", "#28a74594", "#dc354594", "#fd7e1494", "#e83e8c94","#007bff94", "#ffc10794", "#28a74594", "#dc354594", "#fd7e1494", "#e83e8c94"];
  const color="#007bff";
  const color_opacity="#1266f13d";

  $(document).ready(function () {
    const all_item = ['article','project'];
    var timeout = 250;
    setTimeout(() => {
        all_item.forEach(item => {
            setTimeout(() => {
                loadDashboardItem(item);
            }, timeout);
        });
        timeout+=timeout;
    }, timeout);
  });
  async function loadDashboardItem(action){
        await $.ajax({
            type: 'POST',
            url: $(location).attr('href'),
            data: {
                action: action
            },
            success: function(data) { 
                $("#dashboard_"+action).html(data.toString());
            },
        });
  }
</script>
