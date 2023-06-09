<?php
// 获取 POST 请求的原始数据
$payload = file_get_contents('php://input');
// 解析 JSON 数据,因为kook发送过来的post请求一般都是json格式需要解析
$data = json_decode($payload, true);
// 检查是否存在信令类型和数据，在kook的webkook文档里有提到
if (isset($data['s']) && isset($data['d'])) {
    $signalType = $data['s'];
    $signalData = $data['d'];
  
    // 验证请求的 verify_token 是否正确，确保事件来自 Kook 开放平台
  
    $verifyToken = 'your_verify_token'; //请在your_verify_token替换你在开发者后台配置的 verify_token

    // 检查 verify_token 是否匹配
    if (isset($signalData['verify_token']) && $signalData['verify_token'] === $verifyToken) {
        // 验证成功，继续处理 Challenge 请求或事件数据

        // 检查信令类型
    if ($signalType === 0) {
            // 处理 Challenge 请求
    if (isset($signalData['channel_type']) && $signalData['channel_type'] === 'WEBHOOK_CHALLENGE') {
                $challenge = $signalData['challenge'];
                //WEBHOOK_CHALLENGE这里是检测是否是kook发过来的challenge验证，这里的if可以做一个判断，因为后期机器人实际运用时，发送到消息的type不是WEBHOOK_CHALLENGE，方便用户的消息和kook的检测分开          
      
                // 构建回应数据
                $response = array(
                    'challenge' => $challenge
                );

                // 将回应数据编码为 JSON 格式
                $responseJson = json_encode($response);

                // 返回响应给 Kook，包含原样的 challenge 值
                header('Content-Type: application/json');//这里是kook的header要求
                http_response_code(200);
                echo $responseJson;
            }
        } elseif ($signalType === 1) {
            //目前没有用，因为任何数据的signalType都是0
        }
    } else {
        // 验证失败，可以返回错误响应或忽略该请求
        http_response_code(403);
        echo "verify_key验证失败，请尝试检查是否正确";
    }
} else {
    // 处理缺少信令类型或数据的情况
    http_response_code(400);
    echo "无数据";
}
