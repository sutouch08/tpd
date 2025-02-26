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
    $qr  = "SELECT C.CardCode, C.CardName, C.GroupNum, C.SlpCode, C.ECVatGroup, ";
    $qr .= "C.Currency, C.U_TPD_DrugCon AS isControl, C.U_TPD_RA_DrugType AS customer_type, C.U_TPD_BI_SalesTeam AS saleTeam, ";
    $qr .= "C.U_TPD_BI_AreaName AS areaId, C.U_SALE_PERSON AS salePerson, ";
    $qr .= "C.U_TPD_BI_Department AS department, V.Rate ";
    $qr .= "FROM OCRD AS C ";
    $qr .= "LEFT JOIN OVTG AS V ON C.ECVatGroup = V.Code ";
    $qr .= "WHERE C.CardType = 'C' ";
    $qr .= "AND C.validFor = 'Y' ";
    $qr .= "AND C.SlpCode > 0 ";
    $qr .= "AND C.U_TPD_BI_AreaName IS NOT NULL ";
    $qr .= "AND C.U_TPD_BI_AreaName = '{$area_id}' ";
    $qr .= "AND C.U_SALE_PERSON IS NOT NULL ";
    $qr .= "AND C.CardCode LIKE '___{$type}%' ";
    $qr .= "ORDER BY C.CardCode ASC";

    $rs = $this->ms->query($qr);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }


  public function get_all_user_customer_list($type = "V")
  {
    //--- V = vat Q = non vat
    $qr  = "SELECT C.CardCode, C.CardName, C.GroupNum, C.SlpCode, C.ECVatGroup, ";
    $qr .= "C.Currency, C.U_TPD_DrugCon AS isControl, C.U_TPD_RA_DrugType AS customer_type, C.U_TPD_BI_SalesTeam AS saleTeam, ";    
    $qr .= "C.U_TPD_BI_AreaName AS areaId, C.U_SALE_PERSON AS salePerson, ";
    $qr .= "C.U_TPD_BI_Department AS department, V.Rate ";
    $qr .= "FROM OCRD AS C ";
    $qr .= "LEFT JOIN OVTG AS V ON C.ECVatGroup = V.Code ";
    $qr .= "WHERE C.CardType = 'C' ";
    $qr .= "AND C.validFor = 'Y' ";
    $qr .= "AND C.SlpCode > 0 ";
    $qr .= "AND C.U_TPD_BI_AreaName IS NOT NULL ";
    $qr .= "AND C.U_SALE_PERSON IS NOT NULL ";
    $qr .= "AND C.CardCode LIKE '___{$type}%' ";
    $qr .= "ORDER BY C.CardCode ASC";

    $rs = $this->ms->query($qr);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
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
