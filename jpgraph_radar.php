<?php
 require_once('jpgraph_plotmark.inc.php'); class RadarLogTicks extends Ticks { function RadarLogTicks() { } function Stroke(&$aImg,&$grid,$aPos,$aAxisAngle,&$aScale,&$aMajPos,&$aMajLabel) { $start = $aScale->GetMinVal(); $limit = $aScale->GetMaxVal(); $nextMajor = 10*$start; $step = $nextMajor / 10.0; $count=1; $ticklen_maj=5; $dx_maj=round(sin($aAxisAngle)*$ticklen_maj); $dy_maj=round(cos($aAxisAngle)*$ticklen_maj); $ticklen_min=3; $dx_min=round(sin($aAxisAngle)*$ticklen_min); $dy_min=round(cos($aAxisAngle)*$ticklen_min); $aMajPos=array(); $aMajLabel=array(); if( $this->supress_first ) $aMajLabel[]=""; else $aMajLabel[]=$start; $yr=$aScale->RelTranslate($start); $xt=round($yr*cos($aAxisAngle))+$aScale->scale_abs[0]; $yt=$aPos-round($yr*sin($aAxisAngle)); $aMajPos[]=$xt+2*$dx_maj; $aMajPos[]=$yt-$aImg->GetFontheight()/2; $grid[]=$xt; $grid[]=$yt; $aImg->SetLineWeight($this->weight); for($y=$start; $y<=$limit; $y+=$step,++$count ) { $yr=$aScale->RelTranslate($y); $xt=round($yr*cos($aAxisAngle))+$aScale->scale_abs[0]; $yt=$aPos-round($yr*sin($aAxisAngle)); if( $count % 10 == 0 ) { $grid[]=$xt; $grid[]=$yt; $aMajPos[]=$xt+2*$dx_maj; $aMajPos[]=$yt-$aImg->GetFontheight()/2; if( !$this->supress_tickmarks ) { if( $this->majcolor!="" ) $aImg->PushColor($this->majcolor); $aImg->Line($xt+$dx_maj,$yt+$dy_maj,$xt-$dx_maj,$yt-$dy_maj); if( $this->majcolor!="" ) $aImg->PopColor(); } if( $this->label_formfunc != "" ) { $f=$this->label_formfunc; $l = call_user_func($f,$nextMajor); } else $l = $nextMajor; $aMajLabel[]=$l; $nextMajor *= 10; $step *= 10; $count=1; } else if( !$this->supress_minor_tickmarks ) { if( $this->mincolor!="" ) $aImg->PushColor($this->mincolor); $aImg->Line($xt+$dx_min,$yt+$dy_min,$xt-$dx_min,$yt-$dy_min); if( $this->mincolor!="" ) $aImg->PopColor(); } } } } class RadarLinearTicks extends LinearTicks { function RadarLinearTicks() { } function Stroke(&$aImg,&$grid,$aPos,$aAxisAngle,&$aScale,&$aMajPos,&$aMajLabel) { $maj_step_abs = abs($aScale->scale_factor*$this->major_step); $min_step_abs = abs($aScale->scale_factor*$this->minor_step); $nbrmaj = floor(($aScale->world_abs_size)/$maj_step_abs); $nbrmin = floor(($aScale->world_abs_size)/$min_step_abs); $skip = round($nbrmin/$nbrmaj); $ticklen2=$this->major_abs_size; $dx=round(sin($aAxisAngle)*$ticklen2); $dy=round(cos($aAxisAngle)*$ticklen2); $label=$aScale->scale[0]+$this->major_step; $aImg->SetLineWeight($this->weight); for($i=1; $i<=$nbrmaj; ++$i) { $xt=round($i*$maj_step_abs*cos($aAxisAngle))+$aScale->scale_abs[0]; $yt=$aPos-round($i*$maj_step_abs*sin($aAxisAngle)); if( $this->label_formfunc != "" ) { $f=$this->label_formfunc; $l = call_user_func($f,$label); } else $l = $label; $aMajLabel[]=$l; $label += $this->major_step; $grid[]=$xt; $grid[]=$yt; $aMajPos[($i-1)*2]=$xt+2*$dx; $aMajPos[($i-1)*2+1]=$yt-$aImg->GetFontheight()/2; if( !$this->supress_tickmarks ) { if( $this->majcolor!="" ) $aImg->PushColor($this->majcolor); $aImg->Line($xt+$dx,$yt+$dy,$xt-$dx,$yt-$dy); if( $this->majcolor!="" ) $aImg->PopColor(); } } $ticklen2=$this->minor_abs_size; $dx=round(sin($aAxisAngle)*$ticklen2); $dy=round(cos($aAxisAngle)*$ticklen2); if( !$this->supress_tickmarks && !$this->supress_minor_tickmarks) { if( $this->mincolor!="" ) $aImg->PushColor($this->mincolor); for($i=1; $i<=$nbrmin; ++$i) { if( ($i % $skip) == 0 ) continue; $xt=round($i*$min_step_abs*cos($aAxisAngle))+$aScale->scale_abs[0]; $yt=$aPos-round($i*$min_step_abs*sin($aAxisAngle)); $aImg->Line($xt+$dx,$yt+$dy,$xt-$dx,$yt-$dy); } if( $this->mincolor!="" ) $aImg->PopColor(); } } } class RadarAxis extends Axis { var $title_color="navy"; var $title=null; function RadarAxis(&$img,&$aScale,$color=array(0,0,0)) { parent::Axis($img,$aScale,$color); $this->len=$img->plotheight; $this->title = new Text(); $this->title->SetFont(FF_FONT1,FS_BOLD); $this->color = array(0,0,0); } function SetTickLabels($l) { $this->ticks_label = $l; } function Stroke($pos,$aAxisAngle,&$grid,$title,$lf) { $this->img->SetColor($this->color); $x=round($this->scale->world_abs_size*cos($aAxisAngle)+$this->scale->scale_abs[0]); $y=round($pos-$this->scale->world_abs_size*sin($aAxisAngle)); $this->img->SetColor($this->color); $this->img->SetLineWeight($this->weight); if( !$this->hide ) $this->img->Line($this->scale->scale_abs[0],$pos,$x,$y); $this->scale->ticks->Stroke($this->img,$grid,$pos,$aAxisAngle,$this->scale,$majpos,$majlabel); if( $lf && !$this->hide ) { $this->img->SetFont($this->font_family,$this->font_style,$this->font_size); $this->img->SetTextAlign("left","top"); $this->img->SetColor($this->label_color); if( ! $this->hide_labels ) { $n = floor(count($majpos)/2); for($i=0; $i < $n; ++$i) { if( $this->ticks_label != null && isset($this->ticks_label[$i]) ) $this->img->StrokeText($majpos[$i*2],$majpos[$i*2+1],$this->ticks_label[$i]); else $this->img->StrokeText($majpos[$i*2],$majpos[$i*2+1],$majlabel[$i]); } } } $this->_StrokeAxisTitle($pos,$aAxisAngle,$title); } function _StrokeAxisTitle($pos,$aAxisAngle,$title) { $this->title->Set($title); $marg=6+$this->title->margin; $xt=round(($this->scale->world_abs_size+$marg)*cos($aAxisAngle)+$this->scale->scale_abs[0]); $yt=round($pos-($this->scale->world_abs_size+$marg)*sin($aAxisAngle)); if( $this->title->iWordwrap > 0 ) { $title = wordwrap($title,$this->title->iWordwrap,"\n"); } $h=$this->img->GetTextHeight($title)*1.2; $w=$this->img->GetTextWidth($title)*1.2; while( $aAxisAngle > 2*M_PI ) $aAxisAngle -= 2*M_PI; if( $aAxisAngle>=7*M_PI/4 || $aAxisAngle <= M_PI/4 ) $dx=-0.15; if( $aAxisAngle>=M_PI/4 && $aAxisAngle <= 3*M_PI/4 ) $dx=($aAxisAngle-M_PI/4)*2/M_PI; if( $aAxisAngle>=3*M_PI/4 && $aAxisAngle <= 5*M_PI/4 ) $dx=1; if( $aAxisAngle>=5*M_PI/4 && $aAxisAngle <= 7*M_PI/4 ) $dx=(1-($aAxisAngle-M_PI*5/4)*2/M_PI); if( $aAxisAngle>=7*M_PI/4 ) $dy=(($aAxisAngle-M_PI)-3*M_PI/4)*2/M_PI; if( $aAxisAngle<=M_PI/12 ) $dy=(0.5-$aAxisAngle*2/M_PI); if( $aAxisAngle<=M_PI/4 && $aAxisAngle > M_PI/12) $dy=(1-$aAxisAngle*2/M_PI); if( $aAxisAngle>=M_PI/4 && $aAxisAngle <= 3*M_PI/4 ) $dy=1; if( $aAxisAngle>=3*M_PI/4 && $aAxisAngle <= 5*M_PI/4 ) $dy=(1-($aAxisAngle-3*M_PI/4)*2/M_PI); if( $aAxisAngle>=5*M_PI/4 && $aAxisAngle <= 7*M_PI/4 ) $dy=0; if( !$this->hide ) { $this->title->Stroke($this->img,$xt-$dx*$w,$yt-$dy*$h,$title); } } } class RadarGrid extends Grid { function RadarGrid() { } function Stroke(&$img,&$grid) { if( !$this->show ) return; $nbrticks = count($grid[0])/2; $nbrpnts = count($grid); $img->SetColor($this->grid_color); $img->SetLineWeight($this->weight); for($i=0; $i<$nbrticks; ++$i) { for($j=0; $j<$nbrpnts; ++$j) { $pnts[$j*2]=$grid[$j][$i*2]; $pnts[$j*2+1]=$grid[$j][$i*2+1]; } for($k=0; $k<$nbrpnts; ++$k ){ $l=($k+1)%$nbrpnts; if( $this->type == "solid" ) $img->Line($pnts[$k*2],$pnts[$k*2+1],$pnts[$l*2],$pnts[$l*2+1]); elseif( $this->type == "dotted" ) $img->DashedLine($pnts[$k*2],$pnts[$k*2+1],$pnts[$l*2],$pnts[$l*2+1],1,6); elseif( $this->type == "dashed" ) $img->DashedLine($pnts[$k*2],$pnts[$k*2+1],$pnts[$l*2],$pnts[$l*2+1],2,4); elseif( $this->type == "longdashed" ) $img->DashedLine($pnts[$k*2],$pnts[$k*2+1],$pnts[$l*2],$pnts[$l*2+1],8,6); } $pnts=array(); } } } class RadarPlot { var $data=array(); var $fill=false, $fill_color=array(200,170,180); var $color=array(0,0,0); var $legend=""; var $weight=1; var $linestyle='solid'; var $mark=null; function RadarPlot($data) { $this->data = $data; $this->mark = new PlotMark(); } function Min() { return Min($this->data); } function Max() { return Max($this->data); } function SetLegend($legend) { $this->legend=$legend; } function SetLineStyle($aStyle) { $this->linestyle=$aStyle; } function SetLineWeight($w) { $this->weight=$w; } function SetFillColor($aColor) { $this->fill_color = $aColor; $this->fill = true; } function SetFill($f=true) { $this->fill = $f; } function SetColor($aColor,$aFillColor=false) { $this->color = $aColor; if( $aFillColor ) { $this->SetFillColor($aFillColor); $this->fill = true; } } function GetCSIMareas() { JpGraphError::RaiseL(18001); } function Stroke(&$img, $pos, &$scale, $startangle) { $nbrpnts = count($this->data); $astep=2*M_PI/$nbrpnts; $a=$startangle; for($i=0; $i<$nbrpnts; ++$i) { $cs=$scale->RelTranslate($this->data[$i]); $x=round($cs*cos($a)+$scale->scale_abs[0]); $y=round($pos-$cs*sin($a)); $pnts[$i*2]=$x; $pnts[$i*2+1]=$y; $a += $astep; } if( $this->fill ) { $img->SetColor($this->fill_color); $img->FilledPolygon($pnts); } $img->SetLineWeight($this->weight); $img->SetColor($this->color); $img->SetLineStyle($this->linestyle); $pnts[]=$pnts[0]; $pnts[]=$pnts[1]; $img->Polygon($pnts); $img->SetLineStyle('solid'); if( $this->mark->show ) { for($i=0; $i < $nbrpnts; ++$i) { $this->mark->Stroke($img,$pnts[$i*2],$pnts[$i*2+1]); } } } function GetCount() { return count($this->data); } function Legend(&$graph) { if( $this->legend=="" ) return; if( $this->fill ) $graph->legend->Add($this->legend,$this->fill_color,$this->mark); else $graph->legend->Add($this->legend,$this->color,$this->mark); } } class RadarGraph extends Graph { var $posx; var $posy; var $len; var $plots=null, $axis_title=null; var $grid,$axis=null; function RadarGraph($width=300,$height=200,$cachedName="",$timeout=0,$inline=1) { $this->Graph($width,$height,$cachedName,$timeout,$inline); $this->posx=$width/2; $this->posy=$height/2; $this->len=min($width,$height)*0.35; $this->SetColor(array(255,255,255)); $this->SetTickDensity(TICKD_NORMAL); $this->SetScale("lin"); $this->SetGridDepth(DEPTH_FRONT); } function SupressTickMarks($f=true) { if( ERR_DEPRECATED ) JpGraphError::RaiseL(18002); $this->axis->scale->ticks->SupressTickMarks($f); } function HideTickMarks($aFlag=true) { $this->axis->scale->ticks->SupressTickMarks($aFlag); } function ShowMinorTickmarks($aFlag=true) { $this->yscale->ticks->SupressMinorTickMarks(!$aFlag); } function SetScale($axtype,$ymin=1,$ymax=1) { if( $axtype != "lin" && $axtype != "log" ) { JpGraphError::RaiseL(18003,$axtype); } if( $axtype=="lin" ) { $this->yscale = & new LinearScale($ymin,$ymax); $this->yscale->ticks = & new RadarLinearTicks(); $this->yscale->ticks->SupressMinorTickMarks(); } elseif( $axtype=="log" ) { $this->yscale = & new LogScale($ymin,$ymax); $this->yscale->ticks = & new RadarLogTicks(); } $this->axis = & new RadarAxis($this->img,$this->yscale); $this->grid = & new RadarGrid(); } function SetSize($aSize) { if( $aSize < 0.1 || $aSize>1 ) JpGraphError::RaiseL(18004,$aSize); $this->len=min($this->img->width,$this->img->height)*$aSize/2; } function SetPlotSize($aSize) { $this->SetSize($aSize); } function SetTickDensity($densy=TICKD_NORMAL) { $this->ytick_factor=25; switch( $densy ) { case TICKD_DENSE: $this->ytick_factor=12; break; case TICKD_NORMAL: $this->ytick_factor=25; break; case TICKD_SPARSE: $this->ytick_factor=40; break; case TICKD_VERYSPARSE: $this->ytick_factor=70; break; default: JpGraphError::RaiseL(18005,$densy); } } function SetPos($px,$py=0.5) { $this->SetCenter($px,$py); } function SetCenter($px,$py=0.5) { assert($px > 0 && $py > 0 ); $this->posx=$this->img->width*$px; $this->posy=$this->img->height*$py; } function SetColor($c) { $this->SetMarginColor($c); } function SetTitles($title) { $this->axis_title = $title; } function Add(&$splot) { $this->plots[]=$splot; } function GetPlotsYMinMax() { $min=$this->plots[0]->Min(); $max=$this->plots[0]->Max(); foreach( $this->plots as $p ) { $max=max($max,$p->Max()); $min=min($min,$p->Min()); } if( $min < 0 ) JpGraphError::RaiseL(18006,$min); return array($min,$max); } function Stroke($aStrokeFileName="") { $n = count($this->plots); if( !$this->yscale->IsSpecified() && count($this->plots)>0 ) { list($min,$max) = $this->GetPlotsYMinMax(); $this->yscale->AutoScale($this->img,0,$max,$this->len/$this->ytick_factor); } elseif( $this->yscale->IsSpecified() && ( $this->yscale->auto_ticks || !$this->yscale->ticks->IsSpecified()) ) { $min = $this->yscale->scale[0]; $max = $this->yscale->scale[1]; $this->yscale->AutoScale($this->img,$min,$max, $this->len/$this->ytick_factor, $this->yscale->auto_ticks); } $this->yscale->SetConstants($this->posx,$this->len); $nbrpnts=$this->plots[0]->GetCount(); if( $this->axis_title==null ) { for($i=0; $i < $nbrpnts; ++$i ) $this->axis_title[$i] = $i+1; } elseif(count($this->axis_title)<$nbrpnts) JpGraphError::RaiseL(18007); for($i=0; $i < $n; ++$i ) if( $nbrpnts != $this->plots[$i]->GetCount() ) JpGraphError::RaiseL(18008); if( $this->background_image != "" ) { $this->StrokeFrameBackground(); } else { $this->StrokeFrame(); } $astep=2*M_PI/$nbrpnts; for($i=0; $i < $n; ++$i) $this->plots[$i]->Legend($this); $this->legend->Stroke($this->img); $this->footer->Stroke($this->img); if( $this->grid_depth == DEPTH_BACK ) { for( $i=0,$a=M_PI/2; $i < $nbrpnts; ++$i, $a += $astep ) { $this->axis->Stroke($this->posy,$a,$grid[$i],$this->axis_title[$i],$i==0); } } $a=M_PI/2; for($i=0; $i < $n; ++$i ) $this->plots[$i]->Stroke($this->img, $this->posy, $this->yscale, $a); if( $this->grid_depth != DEPTH_BACK ) { for( $i=0,$a=M_PI/2; $i < $nbrpnts; ++$i, $a += $astep ) { $this->axis->Stroke($this->posy,$a,$grid[$i],$this->axis_title[$i],$i==0); } } $this->grid->Stroke($this->img,$grid); $this->StrokeTitles(); if( $this->texts != null ) { foreach( $this->texts as $t) $t->Stroke($this->img); } if( $this->iImgTrans ) { if( !class_exists('ImgTrans') ) { require_once('jpgraph_imgtrans.php'); } $tform = new ImgTrans($this->img->img); $this->img->img = $tform->Skew3D($this->iImgTransHorizon,$this->iImgTransSkewDist, $this->iImgTransDirection,$this->iImgTransHighQ, $this->iImgTransMinSize,$this->iImgTransFillColor, $this->iImgTransBorder); } if( $aStrokeFileName == _IMG_HANDLER ) { return $this->img->img; } else { $this->cache->PutAndStream($this->img,$this->cache_name,$this->inline, $aStrokeFileName); } } } ?>