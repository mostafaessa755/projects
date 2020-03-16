<?php 

if(isset($_GET['pro_add'])){
    include '../back/adminconn.php';

    $db = new crud;
    $conn=$db->dbconn();
    $sql    = "SELECT * FROM products WHERE pro_id = ?";
    $result = $conn->prepare($sql);
    $result->execute(array($_GET['pro_add']));
    while($row=$result->fetch()){
        if($row['pro_qty'] != $_SESSION['product_'.$_GET['pro_add']]){
            $_SESSION['product_'.$_GET['pro_add']]+=1;
            header('Location:../../shopingCart.php');
        }else{
            header('Location:../../shopingCart.php');
        }

    }
}
else if(isset($_GET['pro_rm'])){
    session_start();

    if($_SESSION['product_'.$_GET['pro_rm']]>1){
        $_SESSION['product_'.$_GET['pro_rm']]-=1;
        header('Location:../../shopingCart.php');
    }else{
        header('Location:../../shopingCart.php');
    }

}else if(isset($_GET['pro_del'])){
    session_start();

    $_SESSION['product_'.$_GET['pro_del']] = "0";
    header('Location:../../shopingCart.php');
}

function cart($conn){
    $items = 0;
    $orders= 0;
    $output="";
    foreach($_SESSION as $key=>$val){
        if($val>0){
            if(substr($key,0,8)== "product_"){
                $pro_len = strlen($key);
                $pro_id=substr($key,8,$pro_len);
                $sql    = "SELECT * FROM products WHERE pro_id = ?";
                $result = $conn->prepare($sql);
                $result->execute(array($pro_id));

                while($row=$result->fetch()){
                    $items+=1 * $val;
                    $orders+= ($row['pro_price'] * $val);
                    $sub_total= $row['pro_price'] * $val;
                    $output.=<<<pro_cart
                    <tr>
                        <td>{$row['pro_name']}</td>
                        <td>{$row['pro_price']}</td>
                        <td>{$val}</td>
                        <td>{$sub_total}</td>
                        <td>
                        <a href="templet/front/cart.php?pro_add={$row['pro_id']}" class="btn btn-primary"> + </a>
                        <a href="templet/front/cart.php?pro_rm={$row['pro_id']}" class="btn btn-warning"> - </a>
                        <a href="templet/front/cart.php?pro_del={$row['pro_id']}" class="btn btn-danger"> del</a>
                        </td>
                    </tr>



pro_cart;
                }
            }
        }
    }
    return     $data = array('output'=>$output,'items'=>$items,'orders'=>$orders);
}



function cartHeade($conn){
    if(!empty($_SESSION)){
        $Item_selected = 0;
        $supTotal_item = 0;
        $cart_list = "";

        foreach($_SESSION as $key=>$val){
            if($val>0){
                if(substr($key,0,8)== "product_"){
                    $pro_len = strlen($key);
                    $pro_id=substr($key,8,$pro_len);
                    $sql    = "SELECT * FROM products WHERE pro_id = ?";
                    $result = $conn->prepare($sql);
                    $result->execute(array($pro_id));
                    
                
                    
                    while($row=$result->fetch()){
                        $Item_selected+=1;
                        $supTotal_item += ($row['pro_price'] *$val);
                        
                        $cart_list.=<<<pro_cart1
                        <div class="product-widget">
                            <div class="product-img">
                                <img src="templet/back/img/pro_{$row['pro_id']}/1.jpg" alt="">
                            </div>
                            <div class="product-body">
                                <h3 class="product-name"><a href="#">{$row['pro_name']}</a></h3>
                                <h4 class="product-price"><span class="qty">{$val}x</span>{$row['pro_price']}</h4>
                            </div>
                                <a href="templet/front/cart.php?pro_del={$row['pro_id']}">
                                    <button class="delete"><i class="fa fa-close"></i></button>
                                </a>
                        </div>
pro_cart1;
                    }
                }
            }
        }
        return $datas = array('Item_selected'=>$Item_selected,'supTotal_item'=>$supTotal_item,'cart_list'=>$cart_list);
    }
}