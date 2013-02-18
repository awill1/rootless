{
    "success": true,
    "start_date": "2013-08-02",
    "end_date": "2013-08-07",
    "results": [
        <?php foreach ($rides as $date => $ridesOnDay) : ?>
        {
            "date" : "<?php echo $date; ?>",
            "rides" : [
                <?php foreach ($ridesOnDay as $rideIndex => $ride) : ?>
                {
                    "id": <?php echo $ride->getRideId(); ?>,
                    "is_driver": true,
                    "is_passenger": true,
                    "start_date": <?php 
                    if (is_null($ride->getStartDate()))
                    {
                        echo 'null';
                    }
                    else
                    {
                        echo '"'.$ride->getStartDate().'"';
                    } ?>,
                    "start_time": <?php 
                    if (is_null($ride->getStartTime()))
                    {
                        echo 'null';
                    }
                    else
                    {
                        echo '"'.$ride->getStartTime().'"';
                    } ?>,
                    "asking_price": <?php 
                    if (is_null($ride->getAskingPrice()))
                    {
                        echo 'null';
                    }
                    else
                    {
                        echo $ride->getAskingPrice();
                    } ?>,
                    "seat_count": <?php echo 1;//$ride->getSeatCount(); ?>, 
                    "person" : {
                        "id": 1,
                        "first_name": "Aaron",
                        "last_name": "Williams",
                        "picture_small_url": "/uploads/assets/profile_pictures/profile_aaron_small.jpg"
                    },
                    "route": {
                        "origin_string" : "Flagstaff, AZ",
                        "destination_string" : "Beaver, UT",
                        "encoded_polyline": "ahzuExmkhT`HkIbZ_OqIgpA_cAcjA{cBweDkwEibEu~Aer@wmDiCulCzBusCv~BusBxu@}}Adp@q~Cah@ksOszBazIaiBupQ}yBgnHiuAolIm{D{sE}_BmyB{dA_hBw]olEghAsrAkkAmsAme@}rFss@yrMy~@csDtRqhEcCk`EqXqzBn[m`GvAg|EdNomCcb@szCjl@i}HplFehG`vF}zDdfDmuGn_C}}CtkBcmEloBovJzhDo|FbwF{cDfmBucBpdAi_DaPefA{EyOse@kEq|Asa@gCmbAnFssA|AmZusAwcNelGmxDykCuq@gx@dF{d@_Jgy@olEwxAadE_h@cgEqaAssDejBu~@_n@}v@Ri`@ne@zHxo@g[|p@woA`YkhDtwCmn@rmEwzGj_IerCttD{zAvrA_tA|oDcmAjxPsn@hoPlXhk@sFpz@_lAveJsxAbsCjI~dAdM~f@{PfMwcFsh@c}Bp~@iLj]uAbl@ncDxpIndFlmIzjN|aUvTtmBpOtrR|UniIrbA~dH}KlzEuqAr~FqWtnAB`Ze[zL_CdD[fh@o^rFccB`Jo~Cve@}lBn|@md@baAmiA`IguBx^a_BrkDgn@`tB_iBnfGgn@pm@ul@nq@lAxf@{Jh]sxBud@}vAqg@adAceA_xBobA{c@et@_Ca_Akl@oq@usA_}@qcAu~AsiCdEwz@t`@ms@yb@ulAgGiXs`@yYpIyi@oHeT_i@qg@yzAmpAitAg|Aa_Ain@g_@}aAgWwbAgEyl@oa@sjAmhA_bA_d@{aABqfBceAw_B_b@qfBq`A_qChDy`Cey@}aCcp@mzA{UotBcmAqn@ixAuh@oa@_pAcHkcBwqD_p@{c@}eAdUywBarA}pFckAamAfw@guBxi@yxCrv@mzA~f@uFbcBwGjgAaj@Rql@fNutCYwrIobAuiB{EchDeiA_ZkKkCzv@wEl_@wPvdAcHlo@xf@xlCkh@zoAw~AxiAwh@x~@{j@nd@opB`Big@hPe@bc@`DlUmM`X`Xj\\kw@`@kIxY{t@nwCmV~aAi|BpkDhTjj@fKv~AzHrrEy{@xdDiMre@iVcAsl@gj@etBigCyxB}cC_jA}aAylBw{AqiApm@o|ChvBe`Bxt@acHbSkeByZsZoSoi@{I]muAfAmpByOy^oUcqB~^ajC`_@{aA~u@cVvy@qn@`G_s@eZqx@{UqnAwLmeAe^smB{H`c@gDcnAgiAk`DydAwn@}jBkpDsf@ooAiZmSoCkOaA{MpEyb@aLca@aQ{D}l@sK|BsP"
                    }
                }
                    <?php if ($rideIndex < count($ridesOnDay)) 
                        {   
                            echo ',';
                        }
                    ?>
                <?php endforeach; ?>
            ]
        }
            <?php $maxDate = '2013-04-06'; //max(array_keys($rides)); ?>
            <?php if ($date != $maxDate) 
                {   
                    echo ',';
                }
            ?>
        <?php endforeach; ?>
    ] 
}

