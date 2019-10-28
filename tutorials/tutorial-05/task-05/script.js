$(document).ready(function () {
  const tableData = $('#cat_table td');
  for (let i = 0; i < tableData.length; i += 2) {
    tableData[i].className = 'highlight';
  }
});
