<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\RedirectResponse;

class CheckRole implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // $session = session();

        // $updateRole = $session->get('updateRole');

        // // Kiểm tra nếu $updateRole là null hoặc không phải là chuỗi
        // if ($updateRole === null || !is_string($updateRole)) {
        //     // Xử lý trường hợp khi $updateRole là null hoặc không phải là chuỗi
        //     // Ví dụ, chuyển hướng đến trang đăng nhập hoặc hiển thị một thông báo lỗi
        //     return redirect()->to('/login');
        // }

        // // Kiểm tra nếu vai trò không phải là 'manager'
        // if ($updateRole !== 'manager') {
        //     // Chuyển hướng đến trang đăng nhập nếu người dùng không phải là quản lý
        //     return redirect()->to('/login');
        // }

        // // Cho phép quản lý tiếp tục
        // return $this->delegate;
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
