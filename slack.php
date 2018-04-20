<?php
  $com = explode(',', $_POST['text']);
  if($com[0] == 'task') {
    if($com[1] == 'write') {
      $put = array();
      $done = false;
      $f = fopen("task.csv", "r");
      while($line = fgetcsv($f)) {
        if($com[2] == $line[0]) {
          array_push($put, array($line[0], $com[3]));
          $done = true;
        } else {
          array_push($put, $line);
        }
      }
      fclose($f);
      if($done) {
        $f = fopen("task.csv", "w");
        foreach($put as $li)
          fputcsv($f, $li);
        fclose($f);
        echo $com[2].':'.$com[3].'に変更しました';
      } else {
        $f = fopen("task.csv", "a");
        fputcsv($f, array($com[2], $com[3]));
        fclose($f);
        echo $com[2].':'.$com[3].'を追加しました';
      }
    } elseif($com[1] == 'read') {
      $f = fopen("task.csv", "r");
      if($com[2] == 'all') {
        while ($line = fgetcsv($f)) {
          foreach($line as $key=>$li)
            echo $key==0 ? $li : ':'.$li;
          echo "\n";
        }
          $done = false;
      } else {
        $done = true;
        while($line = fgetcsv($f))
          if($com[2] == $line[0]) {
            echo $line[0].'さんのタスクは'."\n".$line[1];
            $done = false;
          }
        if($done)
          echo '見つかりませんでした名前を確認してください';
      }
      fclose($f);
    } else {sytntax();}
  } else {sytntax();}
  function sytntax() {
    echo 'コマンドを確認してください';
  }
