<div class="col-sm-6 col-xs-12 padding-5 last">
  <table class="table">
    <tr>
      <td class="width-40 bg-green"><?php echo (!empty($header->DocNum) ? "No." : "Series"); ?></td>
      <td class="width-60">
        <?php if(!empty($header->DocNum)) : ?>
        <?php echo $header->BeginStr . $header->DocNum; ?>
        <?php else : ?>
        <?php echo $header->series_name; ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class="width-40 bg-green">Web Order</td>
      <td class="width-60"><?php echo $header->code; ?></td>
    </tr>
    <tr>
      <td class="width-40 bg-green">Status</td>
      <td class="width-60">
        <?php $status = $header->Approved === 'A' ? 'Approved' :($header->Approved === 'R' ? 'Rejected' : 'Pending'); ?>
      </td>
    </tr>
    <tr>
      <td class="width-40 bg-green">Posting Date</td>
      <td class="width-60"><?php echo thai_date($header->DocDate, FALSE, '.'); ?></td>
    </tr>
    <tr>
      <td class="width-40 bg-green">Valid Until</td>
      <td class="width-60"><?php echo thai_date($header->DocDueDate, FALSE, '.'); ?></td>
    </tr>
    <tr>
      <td class="width-40 bg-green">Document Date</td>
      <td class="width-60"><?php echo thai_date($header->TextDate, FALSE, '.'); ?></td>
    </tr>
    <tr>
      <td class="width-40 bg-green">เลขที่ใบเสนอราคาเดิม</td>
      <td class="width-60"><?php echo $header->U_ORIGINALSQ; ?></td>
    </tr>
    <tr>
      <td class="width-40 bg-green">กำหนดยืนราคา</td>
      <td class="width-60"><?php echo $header->BEX_DUEPRICE; ?> วัน</td>
    </tr>
    <tr>
      <td class="width-40 bg-green">กำหนดส่งของภายใน</td>
      <td class="width-60"><?php echo $header->BEX_DUEDELIVERY; ?> วัน</td>
    </tr>
    <tr>
      <td class="width-40 bg-green">Bill To</td>
      <td class="width-60"><?php echo $header->Address; ?></td>
    </tr>
  </table>
</div>
