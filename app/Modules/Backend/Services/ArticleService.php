<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/3
 * Time: 11:28
 */

namespace App\Modules\Backend\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Backend\Models\Article;

class ArticleService
{
    public function __construct()
    {

    }

    public function paginate($request)
    {
        return Article::orderBy('id', 'desc')->paginate($request->get('limit'));
    }

    /**
     * 保存配置
     *
     * @param $configs
     * @return array
     */
    public function saveArticle($request)
    {
        try {
            $data = [
                'title' => $request->get('title'),
                'keywords' => $request->get('keywords'),
                'content' => $request->get('content'),
                'summary' => $request->get('summary'),
                'category_id' => $request->get('category_id'),
            ];

            DB::beginTransaction();
            $article = Article::updateOrCreate(['id' => $request->get('article_id')], $data);

            if (!$article) {
                throw new \Exception("保存文章失败");
            }

            $article->syncLabel($request->get('labels'));

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除文章
     *
     * @param $id
     * @return array
     */
    public function deleteArticle($id)
    {
        try {
            $article = Article::find($id);

            $article->delete();

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}