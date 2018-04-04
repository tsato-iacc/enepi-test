<div class="city-announcement-companies">
  <div class="announcement-table">
    <div class="announcement-tr">
      <div class="announcement-th a-name">ガス会社名</div>
      <div class="announcement-th a-address">所在地</div>
      <div class="announcement-th a-type">
        <div>公表方法</div>
        <div class="a-two">
          <div>HP</div>
          <div>店頭</div>
        </div>
      </div>
      <div class="announcement-th a-date">
        <div>公表時期</div>
        <div class="a-three">
          <div>H29.7月</div>
          <div>H29.10月</div>
          <div>H30.3月</div>
        </div>
      </div>
    </div>
    <?php foreach ($announcement_companies as $ac): ?>
      <div class="announcement-tr">
        <div class="announcement-td a-name a-td-cell"><?= $ac->name; ?></div>
        <div class="announcement-td a-address">
          <div class="a-td-cell"><?= $ac->zip_code; ?></div>
          <div class="a-td-cell"><?= $ac->address; ?></div>
        </div>
        <div class="announcement-td a-type a-two">
          <div class="a-td-cell"><?= $ac->announcement_type ? '' : '◯'; ?></div>
          <div class="a-td-cell"><?= $ac->announcement_type ? '◯' : ''; ?></div>
        </div>
        <div class="announcement-td a-date a-three">
          <div class="a-td-cell"><?= \Helper\TimezoneConverter::areUTCDatesEqual($ac->announcement_date, '2017-06-30 15:00:00') ? '◯' : ''; ?></div>
          <div class="a-td-cell"><?= \Helper\TimezoneConverter::areUTCDatesEqual($ac->announcement_date, '2017-09-30 15:00:00') ? '◯' : ''; ?></div>
          <div class="a-td-cell"><?= \Helper\TimezoneConverter::areUTCDatesEqual($ac->announcement_date, '2018-02-28 15:00:00') ? '◯' : ''; ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
