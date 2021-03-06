<?php
	/** Установщик модуля */

	/** @var array $INFO реестр модуля */
	$INFO = [
		'name' => 'appointment',
		'config' => '1',
		'default_method' => 'orders',
		'default_method_admin' => 'pages',
		'work-time-0' => '',
		'work-time-1' => '',
		'work-time-2' => '',
		'work-time-3' => '',
		'work-time-4' => '',
		'work-time-5' => '',
		'work-time-6' => '',
	];

	/** @var array $COMPONENTS файлы модуля */
	$COMPONENTS = [
		'./classes/components/appointment/classes/collections/AppointmentEmployeesCollection.php',
		'./classes/components/appointment/classes/collections/AppointmentEmployeesSchedulesCollection.php',
		'./classes/components/appointment/classes/collections/AppointmentEmployeesServicesCollection.php',
		'./classes/components/appointment/classes/collections/AppointmentOrdersCollection.php',
		'./classes/components/appointment/classes/collections/AppointmentServiceGroupsCollection.php',
		'./classes/components/appointment/classes/collections/AppointmentServicesCollection.php',
		'./classes/components/appointment/classes/constants/appointmentEmployeesConstantMap.php',
		'./classes/components/appointment/classes/constants/appointmentEmployeesSchedulesConstantMap.php',
		'./classes/components/appointment/classes/constants/appointmentEmployeesServicesConstantMap.php',
		'./classes/components/appointment/classes/constants/appointmentOrdersConstantMap.php',
		'./classes/components/appointment/classes/constants/appointmentServiceGroupsConstantMap.php',
		'./classes/components/appointment/classes/constants/appointmentServicesConstantMap.php',
		'./classes/components/appointment/classes/interfaces/iAppointmentEmployee.php',
		'./classes/components/appointment/classes/interfaces/iAppointmentEmployeeSchedule.php',
		'./classes/components/appointment/classes/interfaces/iAppointmentEmployeeService.php',
		'./classes/components/appointment/classes/interfaces/iAppointmentOrder.php',
		'./classes/components/appointment/classes/interfaces/iAppointmentService.php',
		'./classes/components/appointment/classes/interfaces/iAppointmentServiceGroup.php',
		'./classes/components/appointment/classes/items/AppointmentEmployee.php',
		'./classes/components/appointment/classes/items/AppointmentEmployeeSchedule.php',
		'./classes/components/appointment/classes/items/AppointmentEmployeeService.php',
		'./classes/components/appointment/classes/items/AppointmentOrder.php',
		'./classes/components/appointment/classes/items/AppointmentService.php',
		'./classes/components/appointment/classes/items/AppointmentServiceGroup.php',
		'./classes/components/appointment/admin.php',
		'./classes/components/appointment/autoload.php',
		'./classes/components/appointment/class.php',
		'./classes/components/appointment/customAdmin.php',
		'./classes/components/appointment/customMacros.php',
		'./classes/components/appointment/events.php',
		'./classes/components/appointment/handlers.php',
		'./classes/components/appointment/i18n.en.php',
		'./classes/components/appointment/i18n.php',
		'./classes/components/appointment/includes.php',
		'./classes/components/appointment/install.php',
		'./classes/components/appointment/lang.en.php',
		'./classes/components/appointment/lang.php',
		'./classes/components/appointment/macros.php',
		'./classes/components/appointment/notifier.php',
		'./classes/components/appointment/permissions.php',
		'./classes/components/appointment/services.php'
	];
