<div class="row flex-center-start">
    <div class="col-xl-8 col-md-12 mb-2">
        <div class="view view-cascade gradient-card-header p-2">
            <canvas id="project_line_chart" width="auto"></canvas>
        </div>
    </div>
    <div class="row col-xl-4 col-md-12 mb-2">
        <div class="col-12 view view-cascade gradient-card-header p-2">
            <canvas id="project_bar_chart" width="auto"></canvas>
        </div>
        <div class="col-12 view view-cascade gradient-card-header py-5">
            <canvas id="project_pie_chart" width="auto"></canvas>
        </div>
    </div>
</div>
<script>
  $(document).ready(function () {
    loadBarChart('project_bar_chart','CTKM/Danh mục',<?=$str_name_projects?>,<?=$str_total_projects?>,options,arr_color,arr_color_opacity);
    loadPieChart('project_pie_chart','Tác giả/CTKM',<?=$str_name_users?>,<?=$str_total_users?>,options,arr_color,arr_color_opacity);
    loadLineChart('project_line_chart','Top <?=$limit?> lượt xem CTKM',<?=$str_title_projects?>,<?=$str_view_projects?>,options,color,color_opacity);
  });
</script>