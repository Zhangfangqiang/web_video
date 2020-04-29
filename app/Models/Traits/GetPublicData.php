<?php

namespace App\Models\Traits;

trait GetPublicData
{

    /**
     * 获取数据的方法
     * @param $configArray
     * @return mixed
     */
    public function getData($configArray = null)
    {
        $data = $this;

        #根据开关修改配置树状
        $configArray = $this->treeSortChangeConfig($configArray);

        #预加载
        if (isset($configArray['with']) && !empty($configArray['with'])) {
            $data = $data->with($configArray['with']);
        }

        #select 选项
        if (isset($configArray['select']) && !empty($configArray['select'])) {
            $data = $data->select($configArray['select']);
        }

        #tntsearch 选项
        if (isset($configArray['search']) && !empty($configArray['search'])) {
            $data = $data->whereIn('id', $this->search($configArray['search'])->get()->pluck('id'));
        }

        #其他条件
        if (isset($configArray['otherWhere']) && !empty($configArray['otherWhere'])) {
            foreach ($configArray['otherWhere'] as $key => $snap) {
                if (!is_numeric($key) && !empty($key)) {
                    if (!is_null($snap)) {
                        $data = $data->where($key, $snap);
                    }
                } else {
                    $data = $data->where($snap[0], $snap[1], $snap[2]);
                }
            }
        }

        #whereIn条件
        if (isset($configArray['otherWhereIn']) && !empty($configArray['otherWhereIn'])) {
            foreach ($configArray['otherWhereIn'] as $snap) {
                $data = $data->whereIn($snap[0], explode(',', trim(trim($snap[1],']'),'[')));
            }
        }

        #whereNotNull
        if (isset($configArray['whereNotNull']) && !empty($configArray['whereNotNull'])) {
            foreach ($configArray['whereNotNull'] as $snap) {
                $data = $data->whereNotNull($snap);
            }
        }

        #排序
        if (isset($configArray['order']) && !empty($configArray['order'])) {
            $data = $data->orderBy($configArray['order'][0], $configArray['order'][1]);
        }

        #分段
        if (isset($configArray['limit']) && !empty($configArray['limit']) && isset($configArray['offset'])) {
            $data = $data->offset($configArray['offset'])->limit($configArray['limit']);
        }

        #分页
        if (isset($configArray['paginate']) && !empty($configArray['paginate'])) {
            $data = $data->paginate($configArray['paginate']);
        } else {
            $data = $data->get();
        }

        return $data;
    }

    /**
     * 根据开关修改配置树状
     */
    private function treeSortChangeConfig($configArray)
    {
        if (isset($configArray['tree']) && !empty($configArray['tree'])) {
            $configArray['select'] = \DB::raw(" * , concat(path,',',id) AS paths");
            $configArray['order']  = ['paths', 'asc'];
        }

        return $configArray;
    }
}
