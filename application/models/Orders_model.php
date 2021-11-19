<?php
class Orders_model extends CI_Model
{
  private $tb = "orders";
  private $td = "order_detail";

  public function __construct()
  {
    parent::__construct();
  }


  public function get($code)
  {
    $rs = $this->db->where('code', $code)->get($this->tb);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_detail($id)
  {
    $rs = $this->db->where('id', $id)->get($this->td);

    if($rs->num_rows() === 1)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_details($code)
  {
    $rs = $this->db->where('order_code', $code)->get($this->td);

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function add(array $ds = array())
  {
    if(!empty($ds))
    {
      return $this->db->insert($this->tb, $ds);
    }

    return FALSE;
  }



  public function add_detail(array $ds = array())
  {
    if(!empty($ds))
    {
      if($this->db->insert($this->td, $ds))
      {
        return $this->db->insert_id();
      }
    }

    return FALSE;
  }



  public function update($code, array $ds = array())
  {
    if(!empty($ds) && !empty($code))
    {
      return $this->db->where('code', $code)->update($this->tb, $ds);
    }

    return FALSE;
  }



  public function update_detail($id, array $ds = array())
  {
    if(!empty($ds) && !empty($ds))
    {
      return $this->db->where('id', $id)->update($this->td, $ds);
    }

    return FALSE;
  }



  public function approve_detail($id)
  {
    return $this->db->set('status', 'A')->where('id', $id)->or_where('link_id', $id)->update($this->td);
  }


  public function approve_details($code)
  {
    return $this->db->set('status', 'A')->where('order_code', $code)->update($this->td);
  }


  public function reject_detail($id)
  {
    return $this->db->set('status', 'R')->where('id', $id)->or_where('link_id', $id)->update($this->td);
  }



  public function reject_details($code)
  {
    return $this->db->set('status', 'R')->where('order_code', $code)->update($this->td);
  }



  public function delete_detail($id)
  {
    return $this->db->where('id', $id)->delete($this->td);
  }


  public function delete_details($code)
  {
    return $this->db->where('order_code', $code)->delete($this->td);
  }


  function count_rows(array $ds = array())
  {

    if(!empty($ds['WebCode']))
    {
      $this->db->like('code', $ds['WebCode']);
    }

    if(!empty($ds['CardCode']))
    {
      $this->db->group_start();
      $this->db->like('CardCode', $ds['CardCode']);
      $this->db->or_like('CardName', $ds['CardCode']);
      $this->db->group_end();
    }


    if(!empty($ds['UserName']))
    {
      $this->db->like('uname', $ds['UserName']);
    }


    if(!empty($ds['DocNum']))
    {
      $this->db->like('DocNum', $ds['DocNum']);
    }



    if(!empty($ds['DeliveryNo']))
    {
      $this->db->like('DeliveryNo', $ds['DeliveryNo']);
    }


    if(!empty($ds['InvoiceNo']))
    {
      $this->db->like('InvoiceNo', $ds['InvoiceNo']);
    }


    if(!empty($ds['PoNo']))
    {
      $this->db->like('NumAtCard', $ds['PoNo'] );
    }


    if(!empty($ds['fromDate']) && !empty($ds['toDate']))
    {
      $this->db->where('DocDate >=', from_date($ds['fromDate']));
      $this->db->where('DocDate <=',to_date($ds['toDate']));
    }


    if($ds['Approved'] !== 'all')
    {
      $this->db->where('Approved', $ds['Approved']);
    }


    if($ds['Status'] !== 'all')
    {
      $this->db->where('Status', $ds['Status']);
    }


    if(!$this->isGM && !$this->_SuperAdmin && !$this->isAdmin)
    {
      $teams = $this->user_model->get_user_team($this->_user->id);
      $user = array();
      $group = array();

      //---- case
      if(!empty($teams))
      {
        $i = 1;
        foreach($teams as $rs)
        {
          if($rs->user_role == "Lead")
          {
            //--- เป็น lead ดู user ในทีมว่าม่ใครบ้าง
            $users = $this->user_model->user_in_team($rs->team_id);

            if(!empty($users))
            {
              foreach($users as $user_id)
              {
                if(!isset($user[$user_id]))
                {
                  $user[$user_id] = $user_id;
                }
              }
            }
          }


          $team_customer_group = $this->user_model->get_team_customer_group($rs->team_id);

          if(!empty($team_customer_group))
          {
            foreach($team_customer_group as $tcg)
            {
              if(!isset($group[$tcg->group_id]))
              {
                $group[$tcg->group_id] = $tcg->group_id;
              }
            }
          }

        } //--- end foreach

        //--- ถ้า ว่าง แสดงว่า ไม่ได้เป็น lead จะเห็นเฉพาะเอกสารของตัวเองเท่านั้น
        if(!empty($user) && !empty($group))
        {
          $this->db->where_in('user_id', $user);
          $this->db->where_in('CardGroup', $group);
        }
        else
        {
          $this->db->where('user_id', $this->_user->id);
        }
      }
      else
      {
        $this->db->where('user_id', $this->_user->id);
      }
    }

    return $this->db->count_all_results('orders');
  }





  function get_list(array $ds = array(), $perpage = 20, $offset = 0)
  {

    if(!empty($ds['WebCode']))
    {
      $this->db->like('code', $ds['WebCode']);
    }

    if(!empty($ds['CardCode']))
    {
      $this->db->group_start();
      $this->db->like('CardCode', $ds['CardCode']);
      $this->db->or_like('CardName', $ds['CardCode']);
      $this->db->group_end();
    }


    if(!empty($ds['UserName']))
    {
      $this->db->like('uname', $ds['UserName']);
    }


    if(!empty($ds['DocNum']))
    {
      $this->db->like('DocNum', $ds['DocNum']);
    }



    if(!empty($ds['DeliveryNo']))
    {
      $this->db->like('DeliveryNo', $ds['DeliveryNo']);
    }


    if(!empty($ds['InvoiceNo']))
    {
      $this->db->like('InvoiceNo', $ds['InvoiceNo']);
    }


    if(!empty($ds['PoNo']))
    {
      $this->db->like('NumAtCard', $ds['PoNo'] );
    }


    if(!empty($ds['fromDate']) && !empty($ds['toDate']))
    {
      $this->db->where('DocDate >=', from_date($ds['fromDate']));
      $this->db->where('DocDate <=',to_date($ds['toDate']));
    }


    if($ds['Approved'] !== 'all')
    {
      $this->db->where('Approved', $ds['Approved']);
    }


    if($ds['Status'] !== 'all')
    {
      $this->db->where('Status', $ds['Status']);
    }


    if(!$this->isGM && !$this->_SuperAdmin && !$this->isAdmin)
    {
      $teams = $this->user_model->get_user_team($this->_user->id);
      $user = array();
      $group = array();

      //---- case
      if(!empty($teams))
      {
        $i = 1;
        foreach($teams as $rs)
        {
          if($rs->user_role == "Lead")
          {
            //--- เป็น lead ดู user ในทีมว่าม่ใครบ้าง
            $users = $this->user_model->user_in_team($rs->team_id);

            if(!empty($users))
            {
              foreach($users as $user_id)
              {
                if(!isset($user[$user_id]))
                {
                  $user[$user_id] = $user_id;
                }
              }
            }
          }


          $team_customer_group = $this->user_model->get_team_customer_group($rs->team_id);

          if(!empty($team_customer_group))
          {
            foreach($team_customer_group as $tcg)
            {
              if(!isset($group[$tcg->group_id]))
              {
                $group[$tcg->group_id] = $tcg->group_id;
              }
            }
          }

        } //--- end foreach

        //--- ถ้า ว่าง แสดงว่า ไม่ได้เป็น lead จะเห็นเฉพาะเอกสารของตัวเองเท่านั้น
        if(!empty($user) && !empty($group))
        {
          $this->db->where_in('user_id', $user);
          $this->db->where_in('CardGroup', $group);
        }
        else
        {
          $this->db->where('user_id', $this->_user->id);
        }
      }
      else
      {
        $this->db->where('user_id', $this->_user->id);
      }
    }


    $this->db->order_by('code', 'DESC')->limit($perpage, $offset);

    $rs = $this->db->get('orders');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }





  public function get_currency_rate($code, $date)
  {
    $rs = $this->ms->select('Rate')->where('Currency', $code)->where('RateDate', $date)->get('ORTT');

    if($rs->num_rows() > 0)
    {
      return $rs->row()->Rate;
    }

    return NULL;
  }


  public function get_sale_in($txt)
  {
    $qr = "SELECT SlpCode FROM OSLP WHERE SlpName LIKE N'%{$this->ms->escape_str($txt)}%'";
    $qs = $this->ms->query($qr);

    if($qs->num_rows() > 0)
    {
      $arr = array();
      foreach($qs->result() as $rs)
      {
        $arr[] = $rs->SlpCode;
      }

      return $arr;
    }

    return array('abcdefghijklmnopqrstuvwxyz');
  }



  public function is_exists_sap_order($code)
  {
    $rs = $this->ms
    ->where('U_WEB_ORNO', $code)
    ->where('CANCELED', 'N')
    ->count_all_results('ORDR');
    if($rs > 0)
    {
      return TRUE;
    }

    return FALSE;
  }



  public function get_sap_order($code)
  {
    $rs = $this->ms
    ->select('DocEntry, DocStatus')
    ->where('U_WEB_ORNO', $code)
    ->where('CANCELED', 'N')
    ->get('ORDR');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function get_temp_data($code) //-- web order
  {
    $rs = $this->mc
    ->select('U_WEB_ORNO, CardCode, CardName, F_WebDate, F_SapDate, F_Sap, Message')
    ->where('U_WEB_ORNO', $code)
    ->order_by('DocEntry', 'DESC')
    ->get('ORDR');

    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }


  public function get_temp_order($code)
  {
    $rs = $this->mc
    ->select('DocEntry')
    ->where('U_WEB_ORNO', $code)
    ->group_start()
    ->where('F_Sap', 'N')
    ->or_where('F_Sap IS NULL', NULL, FALSE)
    ->group_end()
    ->get('ORDR');

    if($rs->num_rows() > 0)
    {
      return $rs->result();
    }

    return NULL;
  }



  public function drop_temp_exists_data($docEntry)
  {
    $this->mc->trans_start();
    $this->mc->where('DocEntry', $docEntry)->delete('RDR1');
    $this->mc->where('DocEntry', $docEntry)->delete('ORDR');
    $this->mc->trans_complete();
    return $this->mc->trans_status();
  }



  public function add_temp_order(array $ds = array())
  {
    if($this->mc->insert('ORDR', $ds))
    {
      return $this->mc->insert_id();
    }

    return FALSE;
  }



  public function add_temp_detail(array $ds = array())
  {
    return $this->mc->insert('RDR1', $ds);
  }



  public function get_temp_status($code)
  {
    $rs = $this->mc->select('F_Sap, F_SapDate, Message')->where('U_WEB_ORNO', $code)->order_by('DocEntry', 'DESC')->get('ORDR');
    if($rs->num_rows() > 0)
    {
      return $rs->row();
    }

    return NULL;
  }




  public function get_max_code($pre)
  {
    $rs = $this->db
    ->select_max('code')
    ->like('code', $pre, 'after')
    ->order_by('code', 'DESC')
    ->get($this->tb);

    return $rs->row()->code;
  }

}

 ?>
