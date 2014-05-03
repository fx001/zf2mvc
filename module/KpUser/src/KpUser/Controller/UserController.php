<?php
/**
 * Kittencup (http://www.kittencup.com/)
 * @date 2014 14-4-26 下午12:03
 */

namespace KpUser\Controller;

use KpUser\Event\UserEvent;
use KpUser\Form\UserLoginForm;
use KpUser\Form\UserRegForm;
use KpUser\Options\UserModuleOptionAwareInterface;
use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\Hydrator\ClassMethods;

class UserController extends AbstractActionController implements UserModuleOptionAwareInterface
{
    const ROUTE_NAME = 'KpUser-user';

    protected $userModuleOptions;

    public function setUserModuleOptions(AbstractOptions $options)
    {
        $this->userModuleOptions = $options;
    }

    public function getUserModuleOptions()
    {
        return $this->userModuleOptions;
    }


    public function disabledRegAction()
    {
        return array();
    }

    public function disabledLoginAction()
    {
        return array();
    }

    public function regAction()
    {
        if ($this->userModuleOptions->getDisabledReg()) {
            return $this->redirect()->toRoute(static::ROUTE_NAME, array('action' => disabledReg));
        };

        $form = new UserRegForm();
        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());
            if ($form->isValid()) {

                $formUserEntity = $form->getData();

                $eventManager = $this->getEventManager();
                $userEvent = new UserEvent();
                $userEvent->setUserEntity($formUserEntity)->setForm($form);

                $responseCollection = $eventManager->trigger(UserEvent::USER_REG_PRE, $this, $userEvent);

                if ($responseCollection->last() !== false) {

                    $userTable = $this->getServiceLocator()->get('KpUser\Model\UserTable');

                    if ($id = $userTable->save($formUserEntity)) {
                        $userEvent->getUserEntity()->setId($id);
                        $eventManager->trigger(UserEvent::USER_REG_POST, $this, $userEvent);

                        return $this->redirect()->toRoute('KpUser-login');
                    }

                    $eventManager->trigger(UserEvent::USER_REG_ERROR, $this, $userEvent);
                }
            }
        }

        return array(
            'form' => $form
        );
    }

    public function loginAction()
    {
        if ($this->userModuleOptions->getDisabledLogin()) {
            return $this->redirect()->toRoute(static::ROUTE_NAME, array('action' => disabledLogin));
        };

        $form = new UserLoginForm();

        $request = $this->getRequest();

        if ($request->isPost()) {

            $form->setData($request->getPost());

            if ($form->isValid()) {

                $userEntity = $form->getData();

                $userEvent = new UserEvent();
                $userEvent->setForm($form)->setUserEntity($userEntity)->setUserModuleOptions($this->userModuleOptions);

                $eventManager = $this->getEventManager();

                $responseCollection = $eventManager->trigger(UserEvent::USER_LOGIN_PRE, $this, $userEvent, function ($response) {
                    return $response === false;
                });

                if ($responseCollection->last() !== false) {
                    $dbAdpater = GlobalAdapterFeature::getStaticAdapter();

                    $storage = new Session('kp_user');
                    $adapter = new CredentialTreatmentAdapter($dbAdpater, 'kp_user', $this->userModuleOptions->getIdentityKey(), 'password');
                    $adapter->setIdentity($userEntity->getUsername())->setCredential($userEntity->getPassword());
                    $service = new AuthenticationService($storage, $adapter);

                    $result = $service->authenticate();

                    if ($result->isValid()) {


                        $userInfo = (array)$adapter->getResultRowObject();

                        $hydrator = new ClassMethods();
                        $userEvent->setUserEntity($hydrator->hydrate($userInfo, $userEvent->getUserEntity()));
                        $eventManager->trigger(UserEvent::USER_LOGIN_POST, $this, $userEvent);

                        var_dump($adapter->getIdentity());
                        var_dump($storage->isEmpty());
                        var_dump($userInfo);
                        exit;
                        exit('...login success');

                    }
                    $userEvent->setResult($result);

                    $eventManager->trigger(UserEvent::USER_LOGIN_ERROR,$this,$userEvent);
                    $form->get('username')->setMessages($result->getMessages());

                }
            }

        }

        return array(
            'form' => $form
        );

    }
}
