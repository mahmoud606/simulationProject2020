<?php


class Inventory
{
    public $resultSimulation;
    public $demandDay;
    public function sum($num)
    {
        $sum=0;
        foreach($num as $item) {
            $sum+=$item;
        }
        return $sum;
    }
    public function calculate_probability($num)
    {
         $prob=array();
            $i=0;
         foreach ($num as $item)
         {
             $prob[$i]=$item/self::sum($num);
             $i++;
         }
         return $prob;
    }
    public function calculate_cumulative($num)
    {
        $probability=self::calculate_probability($num);
        $cumulative=array();
        $sum=0;
        $cumulative[0]=$probability[0];
        $len= count($probability);
        for($i=0;$i<$len;$i++)
        {
            $sum+=$probability[$i];
            $cumulative[$i]=$sum;
        }
        return $cumulative;
    }
    public function setInterval($num)
    {
        $i=0;
        $cumulative=(self::calculate_cumulative($num));
        $Interval=array();
        foreach ($cumulative as $item)
        {
            $Interval[$i]=($item) * 100;
            $i++;
        }
        return $Interval;
    }
    public function random($range)
    {
        $random=array();
        for($i=0;$i<$range;$i++)
        {
            $random[$i]=rand(1,99);
        }
        return $random;
    }
    public function DailyDemand()
    {
        if(isset($_POST['submit']))
        {
            $this->demandDay=$_POST['num1'];
        }
        return $this->demandDay;
    }
    public function simulate($range,$num,$random)
    {
        $sum=0;
        $simulation=array();
        $interval=self::setInterval($num);
        for($i=0;$i<$range;$i++)
        {

            for($j=0;$j<count($interval);$j++)
            {
                if($random[$i]<=$interval[$j])
                {
                    $simulation[$i]=self::DailyDemand()[$j];
                    $sum+=self::DailyDemand()[$j];
                    break;
                }
            }
        }
        $this->resultSimulation=$sum;
        return $simulation;
    }
    public function resultSimulation()
    {
        echo $this->resultSimulation;
    }

    public function expectedDailyDemand($num)
    {
        $number=count($num);
        $expect=0;
        $prop=self::calculate_probability($num);
        for($i=0;$i<$number;$i++)
        {
            $expect+=$prop[$i]*self::DailyDemand()[$i];
        }
        return $expect;
    }
}