<div class="row flex-center-start">
    <div class="row col-xl-4 col-md-12 mb-2">
        <div class="col-12 view view-cascade gradient-card-header p-2">
            <canvas id="article_bar_chart" width="auto"></canvas>
        </div>
        <div class="col-12 view view-cascade gradient-card-header py-5">
            <canvas id="article_pie_chart" width="auto"></canvas>
        </div>
    </div>
    <div class="col-xl-8 col-md-12 mb-2">
        <div class="view view-cascade gradient-card-header p-2">
            <canvas id="article_line_chart" width="auto"></canvas>
        </div>
    </div>
</div>
<script>
  $(document).ready(function () {
    loadBarChart('article_bar_chart','Bài viết/Danh mục',<?=$str_name_articles?>,<?=$str_total_articles?>,options,arr_color,arr_color_opacity);
    loadPieChart('article_pie_chart','Tác giả/Bài viết',<?=$str_name_users?>,<?=$str_total_users?>,options,arr_color,arr_color_opacity);
    loadLineChart('article_line_chart','Top <?=$limit?> lượt xem bài viết',<?=$str_title_articles?>,<?=$str_view_articles?>,options,color,color_opacity);
  });
</script>