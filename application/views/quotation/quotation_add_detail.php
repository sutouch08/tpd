<input type="hidden"  id="top-row" value="5" />
<style>
  .table > tr > td {
    padding:3px;
  }
</style>

<div class="row">
  <div class="col-sm-12 col-xs-12 padding-5">
    <button type="button" class="btn btn-sm btn-info" onclick="addRow()">Add Row</button>
    <button type="button" class="btn btn-sm btn-warning" onclick="removeRow()">Delete Row</button>
  </div>
  <div class="divider-hidden">

  </div>
  <div class="col-sm-12 col-xs-12 padding-5 table-responsive">
    <table class="table table-bordered" style="table-layout: fixed; min-width: 100%; width:2545px;">
      <thead>
        <tr class="font-size-10">
          <th class="middle text-center" style="width:35px;"></th>
          <th class="middle text-center" style="width:50px;">#</th>
          <th class="middle text-center" style="width:80px;">Type</th>
          <th class="middle" style="width:250px;">Item No.</th>
          <th class="middle" style="width:250px;">Item Description.</th>
          <th class="middle" style="width:200px;">Item Detail</th>
          <th class="middle" style="width:250px;">Freetext</th>
          <th class="middle" style="width:200px;">Warranty</th>
          <th class="middle" style="width:100px;">Quantity</th>
          <th class="middle" style="width:100px;">Uom</th>
          <th class="middle text-center" style="width:100px;">มูลค่า/หน่วย (ก่อนvat)</th>
          <th class="middle" style="width:100px;">ส่วนลด%</th>
          <th class="middle" style="width:100px;">ส่วนลดตาม%</th>
          <th class="middle" style="width:100px;">Tax Code</th>
          <th class="middle" style="width:100px;">มูลค่า/หน่วย หลังส่วนลด(ก่อนvat)</th>
          <th class="middle text-center" style="width:100px;">มูลค่ารวม (ก่อนvat)</th>
          <!-- <th class="middle text-center" style="width:100px;">GP(%)</th> -->
          <th class="middle" style="width:150px;">Whs</th>
          <th class="middle text-center" style="width:80px;">Allow Promt Doc.</th>
          <th class="middle text-center" style="width:100px;">Qty In Whs</th>
          <th class="middle text-center" style="width:100px;">Commit Qty In Whs</th>
          <th class="middle text-center" style="width:100px;">จำนวนคงเหลือขายได้</th>
          <th class="middle" style="width:100px;">รวมบรรทัด</th>
        </tr>
      </thead>
      <tbody id="details-template">
        <?php $rows = 5; ?>
        <?php $no = 1; ?>
        <?php $uom = select_uom(); ?>
        <?php $taxcode = select_tax_code(); ?>
        <?php $whs = select_whs(); ?>
        <?php while($no <= $rows) : ?>
        <tr id="row-<?php echo $no; ?>">
          <td class="middle text-center">
            <input type="checkbox" class="ace chk" id="chk-<?php echo $no; ?>" value="<?php echo $no; ?>"/>
            <span class="lbl"></span>
          </td>
          <td class="middle text-center no"><?php echo $no; ?></td>
          <td class="middle text-center">
            <select class="form-control input-sm toggle-text" id="type-<?php echo $no; ?>" onchange="toggleText($(this))" data-no="<?php echo $no; ?>">
              <option value="0">-</option>
              <option value="1">Text</option>
            </select>
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm input-item-code" data-id="<?php echo $no; ?>" id="itemCode-<?php echo $no; ?>" />
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm input-item-name" id="itemName-<?php echo $no; ?>" />
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm input-item-detail" id="itemDetail-<?php echo $no; ?>" />
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm free-text" id="freeText-<?php echo $no; ?>" />
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm" id="warranty-<?php echo $no; ?>" maxlength="10" />
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm text-right number input-qty" id="qty-<?php echo $no; ?>" onkeyup="recalAmount($(this))" />
          </td>
          <td class="middle">
            <select class="form-control input-sm uom" id="uom-<?php echo $no; ?>">
              <option value=""></option>
              <?php echo $uom; ?>
            </select>
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm text-right number input-price" id="price-<?php echo $no; ?>" onkeyup="recalAmount($(this))"/>
          </td>
          <td class="middle">
            <input type="number" class="form-control input-sm text-right input-disc1" id="disc1-<?php echo $no; ?>" onkeyup="recalAmount($(this))"/>
          </td>
          <td class="middle">
            <input type="number" class="form-control input-sm text-right input-disc2" id="disc2-<?php echo $no; ?>" onkeyup="recalAmount($(this))"/>
          </td>
          <td class="middle">
            <select class="form-control inpt-sm tax-code" id="taxCode-<?php echo $no; ?>" onchange="recalTotal()">
              <option value=""></option>
              <?php echo $taxcode; ?>
            </select>
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm text-right" id="priceAfDiscBfTax-<?php echo $no; ?>" value="" readonly>
          </td>
          <td class="middle">
            <input type="text" class="form-control input-sm text-right number input-amount" id="lineAmount-<?php echo $no; ?>" onkeyup="recalDiscount($(this))"/>
            <input type="hidden" class="lineDisc" id="lineDiscPrcnt-<?php echo $no; ?>" value="0">
          </td>
          <!--
          <td class="middle">
            <input type="text" class="form-control input-sm text-right gp" id="lineGp-<?php echo $no; ?>" value="" readonly />
          </td>
        -->
          <td class="middle">
            <select class="form-control inpt-sm whs" id="whs-<?php echo $no; ?>" onchange="getStock(<?php echo $no; ?>)">
              <?php echo $whs; ?>
            </select>
          </td>
          <td class="middle text-center">
            <input type="checkbox" id="prompt-<?php echo $no; ?>" class="ace" value="1">
            <span class="lbl"></span>
          </td>
          <td class="middle">
            <input type="number" class="form-control input-sm text-right whs-qty" id="whsQty-<?php echo $no; ?>" readonly/>
          </td>
          <td class="middle">
            <input type="number" class="form-control input-sm text-right commit-qty" id="commitQty-<?php echo $no; ?>" readonly/>
          </td>
          <td class="middle">
            <input type="number" class="form-control input-sm text-right ordered-qty" id="orderedQty-<?php echo $no; ?>" readonly/>
          </td>
          <td class="middle">
            <input type="number" class="form-control input-sm text-right line-count" id="lineCount-<?php echo $no; ?>" />
          </td>
        </tr>

          <?php $no++; ?>
        <?php endwhile; ?>
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </div>
</div>
<hr class="padding-5"/>
<script id="row-template" type="text/x-handlebarsTemplate">
  <tr id="row-{{no}}">
    <td class="middle text-center">
      <input type="checkbox" class="ace chk" id="chk-{{no}}" value="{{no}}"/>
      <span class="lbl"></span>
    </td>
    <td class="middle text-center no">{{no}}</td>
    <td class="middle text-center">
      <select class="form-control input-sm toggle-text" id="type-{{no}}" data-no="{{no}}" onchange="toggleText($(this))">
        <option value="0">-</option>
        <option value="1">Text</option>
      </select>
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm input-item-code" data-id="{{no}}" id="itemCode-{{no}}" />
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm input-item-name" id="itemName-{{no}}" />
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm input-item-detail" id="itemDetail-{{no}}" />
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm free-text" id="freeText-{{no}}" />
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm" id="warranty-{{no}}" maxlength="10" />
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm text-right number input-qty" id="qty-{{no}}" onkeyup="recalAmount($(this))"/>
    </td>
    <td class="middle">
      <select class="form-control input-sm uom" id="uom-{{no}}">
        <option value=""></option>
        <?php echo $uom; ?>
      </select>
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm text-right number input-price" id="price-{{no}}" onkeyup="recalAmount($(this))"/>
    </td>
    <td class="middle">
      <input type="number" class="form-control input-sm text-right input-disc1" id="disc1-{{no}}" onkeyup="recalAmount($(this))"/>
    </td>
    <td class="middle">
      <input type="number" class="form-control input-sm text-right input-disc2" id="disc2-{{no}}" onkeyup="recalAmount($(this))"/>
    </td>
    <td class="middle">
      <select class="form-control inpt-sm tax-code" id="taxCode-{{no}}" onchange="recalTotal()">
        <option value=""></option>
        <?php echo $taxcode; ?>
      </select>
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm text-right" id="priceAfDiscBfTax-{{no}}" value="" readonly>
    </td>
    <td class="middle">
      <input type="text" class="form-control input-sm text-right number input-amount" id="lineAmount-{{no}}" onkeyup="recalDiscount($(this))"/>
      <input type="hidden" class="lineDisc" id="lineDiscPrcnt-{{no}}" value="0">
    </td>
    <!--
    <td class="middle">
      <input type="text" class="form-control input-sm text-right gp" id="lineGp-{{no}}" value="" readonly />
    </td>
    -->
    <td class="middle">
      <select class="form-control inpt-sm whs" id="whs-{{no}}" onchange="getStock({{no}})">
        <?php echo $whs; ?>
      </select>
    </td>
    <td class="middle text-center">
      <input type="checkbox" id="prompt-{{no}}" class="ace" value="1">
      <span class="lbl"></span>
    </td>
    <td class="middle">
      <input type="number" class="form-control input-sm text-right whs-qty" id="whsQty-{{no}}" readonly/>
    </td>
    <td class="middle">
      <input type="number" class="form-control input-sm text-right commit-qty" id="commitQty-{{no}}" readonly/>
    </td>
    <td class="middle">
      <input type="number" class="form-control input-sm text-right ordered-qty" id="orderedQty-{{no}}" readonly/>
    </td>
    <td class="middle">
      <input type="number" class="form-control input-sm text-right line-count" id="lineCount-{{no}}" />
    </td>
  </tr>
</script>

<script id="normal-template" type="text/x-handlebarsTemplate">
<td class="middle text-center">
  <input type="checkbox" class="ace chk" id="chk-{{no}}" value="{{no}}"/>
  <span class="lbl"></span>
</td>
<td class="middle text-center no">{{no}}</td>
<td class="middle text-center">
  <select class="form-control input-sm toggle-text" id="type-{{no}}" data-no="{{no}}" onchange="toggleText($(this))">
    <option value="0" selected>-</option>
    <option value="1">Text</option>
  </select>
</td>
<td class="middle">
  <input type="text" class="form-control input-sm input-item-code" data-id="{{no}}" id="itemCode-{{no}}" />
</td>
<td class="middle">
  <input type="text" class="form-control input-sm input-item-name" id="itemName-{{no}}" />
</td>
<td class="middle">
  <input type="text" class="form-control input-sm input-item-detail" id="itemDetail-{{no}}" />
</td>
<td class="middle">
  <input type="text" class="form-control input-sm free-text" id="freeText-{{no}}" />
</td>
<td class="middle">
  <input type="text" class="form-control input-sm" id="warranty-{{no}}" maxlength="10" />
</td>
<td class="middle">
  <input type="text" class="form-control input-sm text-right number input-qty" id="qty-{{no}}" onkeyup="recalAmount($(this))"/>
</td>
<td class="middle">
  <select class="form-control input-sm uom" id="uom-{{no}}">
    <option value=""></option>
    <?php echo $uom; ?>
  </select>
</td>
<td class="middle">
  <input type="text" class="form-control input-sm text-right number input-price" id="price-{{no}}" onkeyup="recalAmount($(this))"/>
</td>
<td class="middle">
  <input type="number" class="form-control input-sm text-right input-disc1" id="disc1-{{no}}" onkeyup="recalAmount($(this))"/>
</td>
<td class="middle">
  <input type="number" class="form-control input-sm text-right input-disc2" id="disc2-{{no}}" onkeyup="recalAmount($(this))"/>
</td>
<td class="middle">
  <select class="form-control inpt-sm tax-code" id="taxCode-{{no}}" onchange="recalTotal()">
    <option value=""></option>
    <?php echo $taxcode; ?>
  </select>
</td>
<td class="middle">
  <input type="text" class="form-control input-sm text-right" id="priceAfDiscBfTax-{{no}}" value="" readonly>
</td>
<td class="middle">
  <input type="text" class="form-control input-sm text-right number input-amount" id="lineAmount-{{no}}" onkeyup="recalDiscount($(this))"/>
  <input type="hidden" class="lineDisc" id="lineDiscPrcnt-{{no}}" value="0">
</td>
<!--
<td class="middle">
  <input type="text" class="form-control input-sm text-right gp" id="lineGp-{{no}}" value="" readonly />
</td>
-->
<td class="middle">
  <select class="form-control inpt-sm whs" id="whs-{{no}}">
    <?php echo $whs; ?>
  </select>
</td>
<td class="middle text-center">
  <input type="checkbox" id="prompt-{{no}}" class="ace" value="1">
  <span class="lbl"></span>
</td>
<td class="middle">
  <input type="number" class="form-control input-sm text-right whs-qty" id="whsQty-{{no}}" readonly/>
</td>
<td class="middle">
  <input type="number" class="form-control input-sm text-right commit-qty" id="commitQty-{{no}}" readonly/>
</td>
<td class="middle">
  <input type="number" class="form-control input-sm text-right ordered-qty" id="orderedQty-{{no}}" readonly/>
</td>
<td class="middle">
  <input type="number" class="form-control input-sm text-right line-count" id="lineCount-{{no}}" />
</td>
</script>

<script id="text-template" type="text/x-handlebarsTemplate">
  <td class="middle text-center">
    <input type="checkbox" class="ace" id="chk-{{no}}" value="{{no}}"/>
    <span class="lbl"></span>
  </td>
  <td class="middle text-center no">{{no}}</td>
  <td class="middle text-center">
    <select class="form-control input-sm toggle-text" id="type-{{no}}" data-no="{{no}}" onchange="toggleText($(this))">
      <option value="0">-</option>
      <option value="1" selected>Text</option>
    </select>
  </td>
  <td colspan="19">
    <textarea id="text-{{no}}" class="autosize autosize-transition" style="height:150px; width:800px;"></textarea>
  </td>
</script>
