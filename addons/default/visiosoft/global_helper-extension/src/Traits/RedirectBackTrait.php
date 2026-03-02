<?php namespace Visiosoft\GlobalHelperExtension\Traits;

use Illuminate\Http\RedirectResponse;

trait RedirectBackTrait
{
    /**
     * @param bool $withInput
     * @return RedirectResponse
     */
    public function redirectBack(bool $withInput = true): RedirectResponse
    {
        $redirect = $this->redirect->back();
        if ($withInput) {
            $redirect->withInput(request()->all());
        }

        return $redirect;
    }

    /**
     * @param $message
     * @param bool $withInput
     * @return RedirectResponse
     */
    public function redirectBackWithSuccess($message, bool $withInput = false): RedirectResponse
    {
        return $this->redirectBack($withInput)->with('success', ['message' => $message]);
    }

    /**
     * @param $message
     * @param bool $withInput
     * @return RedirectResponse
     */
    public function redirectBackWithError($message, bool $withInput = true): RedirectResponse
    {
        return $this->redirectBack($withInput)->with('error', ['message' => $message]);
    }

    public function redirectTo(string $redirectPath)
    {
        return $this->redirect->to($redirectPath);
    }

}
