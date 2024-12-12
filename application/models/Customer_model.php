<?php
class Customer_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }


  public function get($code)
  {
    $rs = $this->ms->where('CardCode', $code)->get('OCRD');

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }

  public function get_user_customer_list($area_id, $type = "V")
  {
    //--- V = vat Q = non vat
    $rs = $this->ms
    ->select('C.CardCode, C.CardName, C.GroupNum, C.SlpCode, C.ECVatGroup, C.Currency')
    ->select('C.U_TPD_DrugCon AS isControl, C.U_TPD_BI_SalesTeam AS saleTeam')
    ->select('C.U_TPD_BI_AreaName AS areaId, V.Rate')
    ->from('OCRD AS C')
    ->join('OVTG AS V', 'C.ECVatGroup = V.Code', 'left')
    ->where('C.CardType', 'C')
    ->where('C.validFor', 'Y')
    ->where('C.SlpCode >', 0)
    ->where('C.U_TPD_BI_AreaName IS NOT NULL', NULL, FALSE)
    ->where('C.U_TPD_BI_AreaName', $area_id)
    ->where('C.U_BEX_CUST_VQ', $type."-")
    ->where('C.U_SALE_PERSON IS NOT NULL', NULL, FALSE)
    ->order_by('C.CardCode', 'ASC')
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_all_user_customer_list($type = "V")
  {
    //--- V = vat Q = non vat
    $rs = $this->ms
    ->select('C.CardCode, C.CardName, C.SlpCode, C.ECVatGroup, C.Currency, C.U_TPD_DrugCon AS isControl, U_TPD_BI_SalesTeam AS saleTeam, V.Rate')
    ->from('OCRD AS C')
    ->join('OVTG AS V', 'C.ECVatGroup = V.Code', 'left')
    ->where('C.CardType', 'C')
    ->where('C.validFor', 'Y')
    ->where('C.SlpCode >', 0)
    ->where('C.U_TPD_BI_AreaName IS NOT NULL', NULL, FALSE)
    ->where('C.U_BEX_CUST_VQ', $type."-")
    ->where('C.U_SALE_PERSON IS NOT NULL', NULL, FALSE)
    ->order_by('C.CardCode', 'ASC')
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
    //
    // $qry = "";
    // $count = 64;
    // $c = 1;
    // while($c < $count)
    // {
    //   $qry .= $c == 1 ? "OCRD.QryGroup{$c} = 'Y' " : "OR OCRD.QryGroup{$c} = 'Y' ";
    //   $c++;
    // }
    //
    // $qr  = "SELECT OCRD.CardCode, OCRD.CardName, OCRD.SlpCode, OCRD.ECVatGroup, OCRD.Currency, OVTG.Rate ";
    // $qr .= "FROM OCRD LEFT JOIN OVTG ON OCRD.ECVatGroup = OVTG.Code ";
    // $qr .= "WHERE OCRD.CardType = 'C' ";
    // $qr .= "AND OCRD.validFor = 'Y' ";
    // if(!empty($qry))
    // {
    //   $qr .= "AND ({$qry}) ";
    // }
    // $qr .= "AND OCRD.CardCode LIKE '___{$type}%' ";
    // $qr .= "AND OCRD.U_SALE_PERSON IS NOT NULL ";
    // $qr .= "ORDER BY OCRD.CardCode ASC";
    // $rs = $this->ms->query($qr);
    //
    // if($rs->num_rows() > 0)
    // {
    //   return $rs->result();
    // }
    //
    // return NULL;
  }



  public function get_address_ship_to($CardCode, $address = '00000')
  {
    $rs = $this->ms
    ->select('CRD1.*, OCRY.Name AS countryName')
    ->from('CRD1')
    ->join('OCRY', 'CRD1.Country = OCRY.Code', 'left')
    ->where('CRD1.AdresType', 'S')
    ->where('CRD1.CardCode', $CardCode)
    ->where('CRD1.Address', $address)
    ->get();

    if($rs->num_rows() == 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_address_ship_to_code($CardCode)
  {
    $rs = $this->ms
    ->select('Address')
    ->where('AdresType', 'S')
    ->where('CardCode', $CardCode)
    ->get('CRD1');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_address_bill_to($CardCode, $address = '00000')
  {
    $rs = $this->ms
    ->select('CRD1.*, OCRY.Name AS countryName')
    ->from('CRD1')
    ->join('OCRY', 'CRD1.Country = OCRY.Code', 'left')
    ->where('CRD1.AdresType', 'B')
    ->where('CRD1.CardCode', $CardCode)
    ->where('CRD1.Address', $address)
    ->get();

    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_address_bill_to_code($CardCode)
  {
    $rs = $this->ms
    ->select('Address')
    ->where('AdresType', 'B')
    ->where('CardCode', $CardCode)
    ->get('CRD1');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_sale_name_by_customer($CardCode)
  {
    $rs = $this->ms
    ->select('OSLP.SlpName')
    ->from('OCRD')
    ->join('OSLP', 'OCRD.SlpCode = OSLP.SlpCode', 'left')
    ->where('OCRD.CardCode', $CardCode)
    ->get();

    if($rs->num_rows() === 1)
    {
      return $rs->row()->SlpName;
    }

    return NULL;
  }



} //--- end model

 ?>
