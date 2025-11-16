import { AnimatePresence, motion } from 'framer-motion';
import {
    AlertCircle,
    Info,
    Lock,
    LockKeyhole,
    Mail,
    Map,
    MapPin,
    MapPinned,
    Phone,
    School,
    User,
    Users,
} from 'lucide-react';
import type { SchoolAdminFormData } from '../../types/registration';
import { getLGAsForState } from '../../utils/lga-data';

interface SchoolAdminFormProps {
    currentStep: number;
    formData: SchoolAdminFormData;
    onChange: (
        field: keyof SchoolAdminFormData,
        value: string | number,
    ) => void;
    errors?: Partial<Record<keyof SchoolAdminFormData, string>>;
    states: string[];
}

const fadeInScale = {
    initial: { opacity: 0, scale: 0.95 },
    animate: { opacity: 1, scale: 1 },
    exit: { opacity: 0, scale: 0.95 },
    transition: { duration: 0.3 },
};

export default function SchoolAdminForm({
    currentStep,
    formData,
    onChange,
    errors = {},
    states,
}: SchoolAdminFormProps) {
    const totalAmount = formData.numberOfStudents * 1000;

    return (
        <AnimatePresence mode="wait">
            {currentStep === 1 && (
                <motion.div
                    key="step1"
                    {...fadeInScale}
                    className="space-y-4 sm:space-y-5"
                >
                    <div className="mb-4 rounded-xl border border-secondary-200 bg-secondary-50 p-3 sm:p-4">
                        <p className="text-xs text-spiritual-700 sm:text-sm">
                            <Info className="mr-1 inline h-4 w-4" />
                            This will be your administrator account to manage
                            students and exams.
                        </p>
                    </div>

                    <div>
                        <div className="relative">
                            <User className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="text"
                                value={formData.adminName}
                                onChange={(e) =>
                                    onChange('adminName', e.target.value)
                                }
                                placeholder="Administrator Full Name"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.adminName && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.adminName}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <Phone className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="tel"
                                value={formData.adminPhone}
                                onChange={(e) =>
                                    onChange('adminPhone', e.target.value)
                                }
                                placeholder="Administrator Phone Number"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.adminPhone && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.adminPhone}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <Mail className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="email"
                                value={formData.adminEmail}
                                onChange={(e) =>
                                    onChange('adminEmail', e.target.value)
                                }
                                placeholder="Administrator Email Address"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.adminEmail && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.adminEmail}
                            </span>
                        )}
                    </div>
                </motion.div>
            )}

            {currentStep === 2 && (
                <motion.div
                    key="step2"
                    {...fadeInScale}
                    className="space-y-4 sm:space-y-5"
                >
                    <div>
                        <div className="relative">
                            <School className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="text"
                                value={formData.schoolName}
                                onChange={(e) =>
                                    onChange('schoolName', e.target.value)
                                }
                                placeholder="School Name"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.schoolName && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.schoolName}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <Phone className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="tel"
                                value={formData.schoolPhone}
                                onChange={(e) =>
                                    onChange('schoolPhone', e.target.value)
                                }
                                placeholder="School Phone Number"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.schoolPhone && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.schoolPhone}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <Mail className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="email"
                                value={formData.schoolEmail}
                                onChange={(e) =>
                                    onChange('schoolEmail', e.target.value)
                                }
                                placeholder="School Email Address"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.schoolEmail && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.schoolEmail}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <MapPin className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <select
                                value={formData.schoolState}
                                onChange={(e) =>
                                    onChange('schoolState', e.target.value)
                                }
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            >
                                <option value="">Select State</option>
                                {states.map((state) => (
                                    <option key={state} value={state}>
                                        {state}
                                    </option>
                                ))}
                            </select>
                        </div>
                        {errors.schoolState && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.schoolState}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <Map className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <select
                                value={formData.schoolLGA}
                                onChange={(e) =>
                                    onChange('schoolLGA', e.target.value)
                                }
                                disabled={!formData.schoolState}
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 disabled:cursor-not-allowed disabled:opacity-50 sm:text-base"
                                required
                            >
                                <option value="">...Select LGA...</option>
                                {formData.schoolState &&
                                    getLGAsForState(formData.schoolState).map(
                                        (lga) => (
                                            <option key={lga} value={lga}>
                                                {lga}
                                            </option>
                                        ),
                                    )}
                            </select>
                        </div>
                        {errors.schoolLGA && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.schoolLGA}
                            </span>
                        )}
                    </div>
                </motion.div>
            )}

            {currentStep === 3 && (
                <motion.div
                    key="step3"
                    {...fadeInScale}
                    className="space-y-4 sm:space-y-5"
                >
                    <div>
                        <div className="relative">
                            <MapPinned className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <textarea
                                value={formData.schoolAddress}
                                onChange={(e) =>
                                    onChange('schoolAddress', e.target.value)
                                }
                                rows={3}
                                placeholder="Full School Address"
                                className="w-full resize-none rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.schoolAddress && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.schoolAddress}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <Users className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="number"
                                value={formData.numberOfStudents || ''}
                                onChange={(e) =>
                                    onChange(
                                        'numberOfStudents',
                                        parseInt(e.target.value) || 0,
                                    )
                                }
                                min={10}
                                max={10000}
                                placeholder="Number of Students"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        <p className="mt-2 text-xs text-spiritual-600 sm:text-sm">
                            💰 Cost:{' '}
                            <span className="font-bold text-primary-600">
                                ₦{totalAmount.toLocaleString()}.00
                            </span>
                            <span className="text-spiritual-500">
                                {' '}
                                (₦1,000 per student)
                            </span>
                        </p>
                        {errors.numberOfStudents && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.numberOfStudents}
                            </span>
                        )}
                    </div>
                </motion.div>
            )}

            {currentStep === 4 && (
                <motion.div
                    key="step4"
                    {...fadeInScale}
                    className="space-y-4 sm:space-y-5"
                >
                    <div>
                        <div className="relative">
                            <Lock className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="password"
                                value={formData.adminPassword}
                                onChange={(e) =>
                                    onChange('adminPassword', e.target.value)
                                }
                                placeholder="Password"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        <p className="mt-1 text-xs text-spiritual-500">
                            Minimum 8 characters
                        </p>
                        {errors.adminPassword && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.adminPassword}
                            </span>
                        )}
                    </div>

                    <div>
                        <div className="relative">
                            <LockKeyhole className="absolute left-3 top-3.5 h-5 w-5 text-spiritual-400" />
                            <input
                                type="password"
                                value={formData.adminPassword_confirmation}
                                onChange={(e) =>
                                    onChange(
                                        'adminPassword_confirmation',
                                        e.target.value,
                                    )
                                }
                                placeholder="Confirm Password"
                                className="w-full rounded-xl border border-spiritual-300 py-3 pl-10 pr-4 text-sm focus:border-transparent focus:ring-2 focus:ring-primary-500 sm:text-base"
                                required
                            />
                        </div>
                        {errors.adminPassword_confirmation && (
                            <span className="mt-1 block text-sm text-error-600">
                                {errors.adminPassword_confirmation}
                            </span>
                        )}
                    </div>
                </motion.div>
            )}

            {currentStep === 5 && (
                <motion.div
                    key="step5"
                    {...fadeInScale}
                    className="space-y-4 sm:space-y-6"
                >
                    <div className="rounded-xl border border-primary-200 bg-primary-50 p-4 sm:p-6">
                        <h3 className="mb-3 text-base font-bold text-spiritual-900 sm:mb-4 sm:text-lg">
                            📋 Registration Summary
                        </h3>
                        <div className="space-y-2 text-xs sm:space-y-3 sm:text-sm">
                            <div className="flex justify-between">
                                <span className="font-medium">
                                    School Name:
                                </span>
                                <span className="text-right">
                                    {formData.schoolName}
                                </span>
                            </div>
                            <div className="flex justify-between">
                                <span className="font-medium">
                                    School Email:
                                </span>
                                <span className="text-right">
                                    {formData.schoolEmail}
                                </span>
                            </div>
                            <div className="flex justify-between">
                                <span className="font-medium">
                                    School Phone:
                                </span>
                                <span className="text-right">
                                    {formData.schoolPhone}
                                </span>
                            </div>
                            <div className="flex justify-between">
                                <span className="font-medium">Location:</span>
                                <span className="text-right">
                                    {formData.schoolLGA}, {formData.schoolState}
                                </span>
                            </div>
                            <div className="flex justify-between">
                                <span className="font-medium">
                                    Administrator:
                                </span>
                                <span className="text-right">
                                    {formData.adminName}
                                </span>
                            </div>
                            <div className="flex justify-between">
                                <span className="font-medium">
                                    Admin Phone:
                                </span>
                                <span className="text-right">
                                    {formData.adminPhone}
                                </span>
                            </div>
                            <div className="flex items-center justify-between border-t border-primary-300 pt-2 sm:pt-3">
                                <span className="font-bold">Students:</span>
                                <span className="font-bold text-primary-600">
                                    {formData.numberOfStudents.toLocaleString()}
                                </span>
                            </div>
                            <div className="mt-2 flex items-center justify-between rounded-lg border border-warning-200 bg-warning-50 p-2 sm:mt-3 sm:p-3">
                                <span className="font-bold">Total Amount:</span>
                                <span className="text-lg font-bold text-warning-700 sm:text-xl">
                                    ₦{totalAmount.toLocaleString()}.00
                                </span>
                            </div>
                        </div>
                    </div>

                    <div className="rounded-xl border border-secondary-200 bg-secondary-50 p-3 sm:p-4">
                        <p className="text-xs leading-relaxed text-spiritual-700 sm:text-sm">
                            <AlertCircle className="mr-1 inline h-4 w-4 text-secondary-600" />
                            After registration, you'll receive payment
                            instructions via email. Your account will be
                            activated within 24 hours of payment confirmation.
                        </p>
                    </div>
                </motion.div>
            )}
        </AnimatePresence>
    );
}
