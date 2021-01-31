<?php /*a:1:{s:33:"../view/student/exam-content.html";i:1612007428;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>试卷</title>
    <link href="/static/admin/testpaper/main.css" rel="stylesheet" type="text/css" />
    <link href="/static/admin/testpaper/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="/static/admin/testpaper/test.css" rel="stylesheet" type="text/css" />
    <style>
        .hasBeenAnswer {
            background: #5d9cec;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="test_main">
        <div class="test">
            <form action="/stools/exam_submit" method="post">
                <div class="test_title">
                    <input type="hidden" name="eid" value="<?php echo htmlentities($eid); ?>">
                    <font><input type="submit"  value="交卷"></font>
                </div>
                <div class="test_content">
                    <div class="test_content_title">
                        <h2>单选题</h2>
                        <p>
                            <span>共</span><i
                                class="content_lit"><?php echo htmlentities($select['num']); ?></i><span>题，</span><span>合计</span><i
                                class="content_fs"><?php echo htmlentities($select['total_points']); ?></i><span>分</span>
                        </p>
                    </div>
                </div>
                <div class="test_content_nr">
                    <ul>
                        <li id="<?php echo htmlentities($listen['pid']); ?>">
                            <div class="test_content_nr_tt">
                                <i><?php echo htmlentities($listen['pid']); ?></i>听力<span>(<?php echo htmlentities($listen['value']); ?>分)</span>
                                <font><?php echo htmlentities($listen['content']); ?></font><b class="icon iconfont">&#xe881;</b>
                                <audio id="audio1" controls="controls">
                                    <source src="<?php echo htmlentities($url); ?>" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                                </audio>
                            </div>

                            <div class="test_content_nr_main">
                                <ul>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($listen['pid']); ?>"id="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_a" value="a" />
                                        <label for="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_a">A.<p class="ue" style="display: inline;"><?php echo htmlentities($listen['a']); ?></p></label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($listen['pid']); ?>"id="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_b" value="b" />
                                        <label for="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_b">B.<p class="ue" style="display: inline;"><?php echo htmlentities($listen['b']); ?></p></label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($listen['pid']); ?>"id="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_c" value="c" />
                                        <label for="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_c">C.<p class="ue" style="display: inline;"><?php echo htmlentities($listen['c']); ?></p></label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($listen['pid']); ?>"id="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_d" value="d" />
                                        <label for="0_answer_<?php echo htmlentities($listen['pid']); ?>_option_d">D.<p class="ue" style="display: inline;"><?php echo htmlentities($listen['d']); ?></p></label>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li id="<?php echo htmlentities($read['pid']); ?>">
                            <div class="test_content_nr_tt">
                                <i><?php echo htmlentities($read['pid']); ?></i>阅读<span>(<?php echo htmlentities($read['value']); ?>分)</span>
                                <font><?php echo htmlentities($read['content']); ?></font><b class="icon iconfont">&#xe881;</b>
                            </div>

                            <div class="test_content_nr_main">
                                <ul>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($read['pid']); ?>" id="0_answer_<?php echo htmlentities($read['pid']); ?>_option_a" value="a" />
                                        <label for="0_answer_<?php echo htmlentities($read['pid']); ?>_option_a">A.<p class="ue" style="display: inline;"><?php echo htmlentities($read['a']); ?></p></label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($read['pid']); ?>" id="0_answer_<?php echo htmlentities($read['pid']); ?>_option_b" value="b" />
                                        <label for="0_answer_<?php echo htmlentities($read['pid']); ?>_option_b">B.<p class="ue" style="display: inline;"><?php echo htmlentities($read['b']); ?></p></label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($read['pid']); ?>" id="0_answer_<?php echo htmlentities($read['pid']); ?>_option_c" value="c" />
                                        <label for="0_answer_<?php echo htmlentities($read['pid']); ?>_option_c">C.<p class="ue" style="display: inline;"><?php echo htmlentities($read['c']); ?></p></label>
                                    </li>
                                    <li class="option">
                                        <input type="radio" class="radioOrCheck" name="<?php echo htmlentities($read['pid']); ?>" id="0_answer_<?php echo htmlentities($read['pid']); ?>_option_d" value="d" />
                                        <label for="0_answer_<?php echo htmlentities($read['pid']); ?>_option_d">D.<p class="ue" style="display: inline;"><?php echo htmlentities($read['d']); ?></p></label>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li id="<?php echo htmlentities($write['wid']); ?>">
                            <div class="test_content_nr_tt">
                                <i><?php echo htmlentities($write['wid']); ?></i>写作<span>(<?php echo htmlentities($write['value']); ?>分)</span>
                                <font><?php echo htmlentities($write['subject']); ?></font><b class="icon iconfont">&#xe881;</b>
                            </div>
                            <div class="test_content_nr_main">
                                    <textarea name="write" id="0_answer_<?php echo htmlentities($write['wid']); ?>_option_a"></textarea>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</body>
</html>