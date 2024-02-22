<?php
namespace app\admin\controller;


class Mxone extends Base
	{
		public function mxoneset()
		{
			if (Request()->isPost()) {
				$config = input();
				$config_new["mxcms"] = $config["mxcms"];
				$config_old = config("mxonest");
				$config_new = array_merge($config_old, $config_new);
				$res = mac_arr2file(APP_PATH . "extra/mxonest.php", $config_new);
				if ($res === false) {
					return $this->error("保存失败，请重试!");
				}
				return $this->success("保存成功!");
			}
			$this->assign("config", config("mxonest"));
			return $this->fetch("admin@system/mxcms");
		}
	}
