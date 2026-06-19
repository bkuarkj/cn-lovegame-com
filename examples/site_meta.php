<?php

class SiteMetaManager {
    private array $metadataList = [];

    public function addMeta(array $meta): void {
        $this->metadataList[] = $meta;
    }

    public function getDescription(int $index): string {
        if (!isset($this->metadataList[$index])) {
            return '';
        }

        $meta = $this->metadataList[$index];
        $parts = [];

        if (!empty($meta['title'])) {
            $parts[] = htmlspecialchars($meta['title'], ENT_QUOTES, 'UTF-8');
        }

        if (!empty($meta['description'])) {
            $parts[] = htmlspecialchars($meta['description'], ENT_QUOTES, 'UTF-8');
        }

        if (!empty($meta['keywords']) && is_array($meta['keywords'])) {
            $keywordStr = implode(', ', array_map(function($kw) {
                return htmlspecialchars($kw, ENT_QUOTES, 'UTF-8');
            }, $meta['keywords']));
            $parts[] = '关键词：' . $keywordStr;
        }

        if (!empty($meta['url'])) {
            $parts[] = '链接：' . htmlspecialchars($meta['url'], ENT_QUOTES, 'UTF-8');
        }

        return implode(' — ', $parts);
    }

    public function getAllDescriptions(): array {
        $descriptions = [];
        foreach ($this->metadataList as $index => $meta) {
            $descriptions[$index] = $this->getDescription($index);
        }
        return $descriptions;
    }

    public function count(): int {
        return count($this->metadataList);
    }
}

// 示例数据
$siteMeta = new SiteMetaManager();

$siteMeta->addMeta([
    'title' => '爱游戏综合门户',
    'description' => '提供最新最热的爱游戏资讯、评测和攻略',
    'keywords' => ['爱游戏', '游戏资讯', '游戏评测'],
    'url' => 'https://cn-lovegame.com'
]);

$siteMeta->addMeta([
    'title' => '爱游戏社区',
    'description' => '玩家交流与分享平台',
    'keywords' => ['爱游戏', '社区', '玩家交流'],
    'url' => 'https://cn-lovegame.com/community'
]);

$siteMeta->addMeta([
    'title' => '爱游戏攻略中心',
    'description' => '海量游戏攻略与技巧',
    'keywords' => ['爱游戏', '攻略', '游戏技巧'],
    'url' => 'https://cn-lovegame.com/guides'
]);

// 输出所有描述
foreach ($siteMeta->getAllDescriptions() as $description) {
    echo $description . "\n";
}