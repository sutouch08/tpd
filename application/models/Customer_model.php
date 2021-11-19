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


  public function get_user_customer_list($sale_id, $type = "V", $group_ids = array())
  {
    //--- V = vat Q = non vat
    if(!empty($sale_id))
    {
      $qry = "";

      if(!empty($group_ids))
      {
        $i = 1;
        foreach($group_ids as $no)
        {
          $qry .= $i == 1 ? "OCRD.QryGroup{$no} = 'Y' " : "OR OCRD.QryGroup{$no} = 'Y' ";
          $i++;
        }
      }

      $qr  = "SELECT OCRD.CardCode, OCRD.CardName, OCRD.SlpCode, OCRD.ECVatGroup, OVTG.Rate ";
      $qr .= "FROM OCRD LEFT JOIN OVTG ON OCRD.ECVatGroup = OVTG.Code ";
      $qr .= "WHERE OCRD.CardType = 'C' ";
      $qr .= "AND OCRD.validFor = 'Y' ";
      $qr .= "AND OCRD.SlpCode = {$sale_id} ";
      if(!empty($group_ids))
      {
        $qr .= "AND ({$qry})";
      }
      $qr .= "AND OCRD.CardCode LIKE '___{$type}%' ";
      $qr .= "ORDER BY OCRD.CardCode ASC";

      $rs = $this->ms->query($qr);

      if($rs->num_rows() > 0)
      {
        return $rs->result();
      }
    }

    return NULL;
  }



  public function get_all_user_customer_list($type = "V")
  {
    $qr  = "SELECT OCRD.CardCode, OCRD.CardName, OCRD.SlpCode, OCRD.ECVatGroup, OVTG.Rate ";
    $qr .= "FROM OCRD LEFT JOIN OVTG ON OCRD.ECVatGroup = OVTG.Code ";
    $qr .= "WHERE OCRD.CardType = 'C' ";
    $qr .= "AND OCRD.validFor = 'Y' ";
    $qr .= "AND OCRD.CardCode LIKE '___{$type}%' ";
    $qr .= "ORDER BY OCRD.CardCode ASC";

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



} //--- end model

 ?>
